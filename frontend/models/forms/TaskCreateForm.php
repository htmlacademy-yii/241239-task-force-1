<?php


namespace frontend\models\forms;


use frontend\models\Status;
use frontend\models\Task;
use yii\base\Model;

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
            [['title', 'description', 'category', 'files', 'budget', 'time'], 'safe']
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
    }

}
