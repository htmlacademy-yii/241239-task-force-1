<?php


namespace frontend\models\forms;


use frontend\models\Attachment;
use frontend\models\Categories;
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
            [['title', 'description'], 'string', 'min' => 1],
            [['category'], 'exist', 'targetClass' => Categories::class, 'targetAttribute' => 'id'],
            [['budget'], 'number', 'min' => '1'],
            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 0],
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
        $task->author_id = \Yii::$app->user->userInfos->id;
        $task->att_id = \Yii::$app->session->get('att_id');

        $task->save();

        \Yii::$app->session->remove('att_id');
        return true;
    }

}
