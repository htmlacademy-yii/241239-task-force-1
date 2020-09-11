<?php

namespace TaskForce\Utils;

class DataLoader extends Data
{
    private $fileArray = [];

    public function scanDirectory($path):array {
        $iterator = new \DirectoryIterator($path);


        while($iterator->valid()) {
            $file = $iterator->current();
            if ($file != "." && $file != "..") {
                $this->fileArray[] = $path . "/" . $file->getFilename();
            }
            $iterator->next();
        }
        return $this->fileArray;
    }

    public function toSql():void {
        foreach ($this->fileArray as $item) {
            $this->convertFromCsvToSql($item);
        }
    }


    protected function convertFromCsvToSql($path):void
    {
        $file = new \SplFileObject($path);

        $catName = basename($path, '.csv');

        $openFileSql = new \SplFileObject($catName . ".sql", "w+");

        $file->setFlags(\SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE | \SplFileObject::READ_AHEAD | \SplFileObject::READ_CSV);
        $dataLine = implode(',', $file->current());

        // записываем в файл первую строку с именами полей
        $openFileSql->fwrite("INSERT INTO TASK_FORCE.{$catName}({$dataLine}) VALUES \n");

        // записываем остальные строки с данными, перебирая построчно в цикле
        while (!$file->eof()) {

            $line = $file->fgetcsv();
            //продолжаем цикл, если в нем есть перенос строки
            if ($line === null) {
                continue;
            }

            // склеиваем в строку данные массива
            $data = implode("\",\"", $line);

            // записываем данные запросов
            $queryData = "\t" . "(\"" . $data . "\")" . "," . "\n";

            $openFileSql->fwrite($queryData);
        }
        //открываем для очистки от пустых строк и переносов
        $r = new \SplFileObject($catName . '.sql', "r+");

        //открываем файл для перезаписи
        $reWriteFile = new \SplFileObject($catName . '.sql', "c");

        $fileToString = '';

        while (!$r->eof()) {
            $fileToString .= $r->fgets();
        }
        //удаляем перенос в конце последней строки
        $trimBrake = rtrim($fileToString, "\n");
        // удаляем запятую в конце последней строки
        $trimColon = substr($trimBrake, 0, -1);
        // перезаписываем файл, добавляя в конце ";"
        $reWriteFile->fwrite($trimColon . ";");


        // перемещаем все файлы в отдельную папку
        $folder = "queries";

        // проверяем, существует ли папка. Если нет, то создаем
        if (!is_dir($folder)) {
            mkdir($folder);
        }

        $movedFile = $catName . '.sql';

        chmod($folder, 0777);

        $new_file = $folder . "/" . $movedFile;


        // копируем
        copy($movedFile, $new_file);

        chmod($new_file, 0777);
        // удаляем
        unlink($movedFile);
    }

}
