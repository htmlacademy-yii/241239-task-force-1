<?php


namespace frontend\controllers;


use frontend\models\forms\SignUpForm;
use Yii;
use yii\web\Controller;

class SignUpController extends Controller
{
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/tasks');
        }

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


}
