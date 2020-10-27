<?php


namespace frontend\controllers;

use frontend\models\forms\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class LandingController extends Controller
{
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/tasks');
        }

        $model = new LoginForm();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->login();
            $this->goBack('/tasks');
        }

        return $this->renderPartial('index', [
            'model' => $model
        ]);
    }

}
