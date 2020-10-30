<?php


namespace frontend\controllers;


use Yii;
use yii\web\Controller;

class LogoutController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->user->logout();
        $this->goHome();
    }
}
