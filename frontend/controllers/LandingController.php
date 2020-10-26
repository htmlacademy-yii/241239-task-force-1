<?php


namespace frontend\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class LandingController extends Controller
{
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }

}
