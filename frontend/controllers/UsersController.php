<?php


namespace frontend\controllers;



use frontend\models\forms\UserForm;
use frontend\models\User;
use frontend\models\UserInfo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UsersController extends Controller
{
    public function actionIndex()
    {
          $users = User::find();
          $model = new UserForm();

          if (\Yii::$app->request->isGet) {
              $model->load(\Yii::$app->request->get());
              $model->applyFilters($users);
          }

        return $this->render('index', [
            'users' => $users->joinWith('userInfos')->andWhere(['role_id' => User::DEVELOPER_ROLE])->all(),
            'model' => $model
        ]);
    }

    public function actionView($id)
    {
        $user = UserInfo::findOne($id);
        if (empty($user)) {
            throw new NotFoundHttpException("Пользователя не существует");
        }

        return $this->render('view', [
            'user' => $user
        ]);
    }
}
