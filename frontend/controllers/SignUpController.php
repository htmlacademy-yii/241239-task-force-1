<?php


namespace frontend\controllers;


use frontend\models\User;
use Yii;
use yii\web\Controller;

class SignUpController extends Controller
{
    public function actionIndex()
    {
        $model = new User();
        $model->load(\Yii::$app->request->post());


        if (Yii::$app->request->post()) {

            if ($model->validate()) {
                $model->setPassword($model->password);
                return $model->save() && $this->goHome();
            }
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }


}
