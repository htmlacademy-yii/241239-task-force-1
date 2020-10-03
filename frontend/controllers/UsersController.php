<?php


namespace frontend\controllers;



use frontend\models\User;
use frontend\models\UserInfo;
use yii\web\Controller;

class UsersController extends Controller
{
    public function actionIndex()
    {
          $users = User::find()->joinWith(['userInfos'])->where(['role_id' => User::DEVELOPER_ROLE])->all();

        return $this->render('index', [
            'users' => $users,
        ]);
    }
}
