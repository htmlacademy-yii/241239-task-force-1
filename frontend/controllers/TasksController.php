<?php


namespace frontend\controllers;


use frontend\models\forms\TaskCreateForm;
use frontend\models\forms\TaskForm;
use frontend\models\Status;
use frontend\models\Task;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use function foo\func;

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

    public function actionCreate()
    {
        $model = new TaskCreateForm();
        $model->load(Yii::$app->request->post());

        if (Yii::$app->request->post()) {
            if ($model->saveTask()) {
                $this->redirect(['/tasks']);
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionLoadFiles()
    {
        if (Yii::$app->request->isAjax) {
            $images = Yii::$app->request->post();
        }
    }

    public function beforeAction($action)
    {
        if ($this->action->id == 'load-files') {
            $this->enableCsrfValidation = false;
        }

        return true;
    }


    public function behaviors()
    {
        $rules = parent::behaviors();
        $rule = [
            'allow' => false,
            'actions' => ['create'],
            'matchCallback' => function ($rule, $action) {
                $user = Yii::$app->user->getIdentity();
                return !$user->isAuthor();
            },
            'denyCallback' => function ($rule, $action) {
                return $this->goHome();
            }
        ];

        array_unshift($rules['access']['rules'], $rule);

        return $rules;
    }
}
