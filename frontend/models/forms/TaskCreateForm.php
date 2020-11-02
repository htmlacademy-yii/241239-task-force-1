<?php


namespace frontend\models\forms;


use frontend\models\Attachment;
use frontend\models\Status;
use frontend\models\Task;
use yii\base\Model;
use yii\web\UploadedFile;

class TaskCreateForm extends Model
{
    public $title;
    public $description;
    public $category;
    public $files;
    public $budget;
    public $time;

    public function rules()
    {
        return [
            [['title', 'description', 'category', 'files', 'budget', 'time'], 'safe'],
            [['title', 'description', 'category', 'budget'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название',
            'description' => 'Описание',
            'category' => 'Категория',
            'files' => 'Файлы',
            'budget' => 'Бюджет',
            'time' => 'Время окончания'
        ];
    }

    public function upload($task)
    {
        if ($this->validate()) {
            $this->files = UploadedFile::getInstances($this, 'files');
            foreach ($this->files as $file) {
                $name = 'uploads/' . $file->baseName . '.' . $file->extension;
                $file->saveAs($name);
                $uploadedFile = new Attachment();
                $uploadedFile->url = $name;
                $uploadedFile->task_id = (int) $task->id;
                $uploadedFile->save();
            }

            return true;
        }
        return false;
    }

    public function saveTask()
    {
        if (!$this->validate()) {
            return false;
        }

        $task = new Task();

        $task->name = $this->title;
        $task->description = $this->description;
        $task->status_id = Status::STATUS_NEW;
        $task->price =  (int) $this->budget;
        $task->category_id =  (int) $this->category;
        $task->author_id = \Yii::$app->user->getId();

        $task->save();

        $this->upload($task);
    }

}
