<?php


namespace frontend\controllers;


use frontend\models\Status;
use frontend\models\Task;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $tasks = Task::find()->where(['status_id' => Status::STATUS_NEW])->all();
        return $this->render('index', [
            'tasks' => $tasks
        ]);
    }
}