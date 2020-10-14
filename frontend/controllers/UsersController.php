<?php


namespace frontend\controllers;



use frontend\models\forms\UserForm;
use frontend\models\User;
use frontend\models\UserInfo;
use yii\web\Controller;

class UsersController extends Controller
{
    public function actionIndex()
    {
          $users = User::find()->joinWith('userInfos')->where(['role_id' => User::DEVELOPER_ROLE]);
          $model = new UserForm();

          if (\Yii::$app->request->isPost) {
              $model->load(\Yii::$app->request->post());
              $model->applyFilters($users);
          }

        return $this->render('index', [
            'users' => $users->all(),
            'model' => $model
        ]);
    }
}
