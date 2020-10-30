<?php


namespace frontend\controllers;


use frontend\models\forms\TaskForm;
use frontend\models\Status;
use frontend\models\Task;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TasksController extends SecuredController
{
    public function actionIndex()
    {
        $model = new TaskForm();
        $tasks = Task::find();
        $model->load(\Yii::$app->request->get());
        $model->applyFilters($tasks);

        return $this->render('index', [
            'tasks' => $tasks->andWhere(['status_id' => Status::STATUS_NEW])->all(),
            'model' => $model
        ]);
    }

    public function actionView($id)
    {
        $task = Task::findOne($id);
        if (empty($task)) {
            throw new NotFoundHttpException("Задание с № $id не найдено");
        }
        return $this->render('view', [
            'task' => $task
        ]);
    }
}
