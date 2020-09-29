<?php


namespace frontend\controllers;


use frontend\models\Task;
use yii\db\Query;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $tasks = Task::find()->where(['status' => 'Новое'])->all();

        return $this->render('index', [
            'tasks' => $tasks
        ]);
    }
}
