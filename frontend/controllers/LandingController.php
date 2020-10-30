<?php


namespace frontend\controllers;

use frontend\models\forms\LoginForm;
use frontend\models\Task;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class LandingController extends Controller
{
    public function actionIndex()
    {

        $model = new LoginForm();
        $tasks = Task::find()->orderBy('created_at')->limit(4)->all();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->login();
            $this->goBack(['/tasks']);
        }

        return $this->renderPartial('index', [
            'model' => $model,
            'tasks' => $tasks
        ]);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'denyCallback' => function ($rule, $action) {
                    return $this->redirect('/tasks');
                },
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],

                    ],
                ],
            ]
        ];
    }

}
