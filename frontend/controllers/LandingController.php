<?php


namespace frontend\controllers;

use frontend\models\forms\LoginForm;
use yii\filters\AccessControl;
use yii\web\Controller;

class LandingController extends Controller
{
    public function actionIndex()
    {
        $model = new LoginForm();
        return $this->renderPartial('index', [
            'model' => $model
        ]);
    }

}
