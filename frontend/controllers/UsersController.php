<?php


namespace frontend\controllers;



use frontend\models\UserInfo;
use yii\web\Controller;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $users = UserInfo::find()->where(['role_id' => 1])->all();

        return $this->render('index', [
            'users' => $users,
        ]);
    }
}
