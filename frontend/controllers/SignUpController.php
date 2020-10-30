<?php


namespace frontend\controllers;


use frontend\models\forms\SignUpForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SignUpController extends Controller
{
    public function actionIndex()
    {
        $model = new SignUpForm();
        $model->load(Yii::$app->request->post());

        if (Yii::$app->request->post()) {
            if ($model->validate()) {
                $model->registerUser();
                return $this->goHome();
            }
        }

        return $this->render('index', [
            'model' => $model
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
