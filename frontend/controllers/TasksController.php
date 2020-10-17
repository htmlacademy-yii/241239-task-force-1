<?php


namespace frontend\controllers;


use frontend\models\forms\TaskForm;
use frontend\models\Status;
use frontend\models\Task;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $model = new TaskForm();
        $tasks = Task::find();
        if (\Yii::$app->request->isGet) {
            $model->load(\Yii::$app->request->get());
            $model->applyFilters($tasks);
        }
        return $this->render('index', [
            'tasks' => $tasks->andWhere(['status_id' => Status::STATUS_NEW])->all(),
            'model' => $model
        ]);
    }

    public function actionShow($id)
    {
        $task = Task::find()->where(['id' => $id])->one();
        return $this->render('show', [
            'task' => $task
        ]);
    }
}
