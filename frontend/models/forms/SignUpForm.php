<?php


namespace frontend\models\forms;


use frontend\models\Cities;
use frontend\models\User;
use frontend\models\UserInfo;
use Yii;
use yii\base\Model;

class SignUpForm extends Model
{
    public $email;
    public $name;
    public $city_id;
    public $password;

    public function rules()
    {
        return [
            [['email', 'password', 'city_id', 'name'], 'required'],
            [['city_id'], 'integer'],
            [['created_at'], 'safe'],
            [['email'], 'string', 'max' => 255],
            [['password'], 'string', 'min' => 8, 'max' => 255],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => User::class],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Электронная почта',
            'name' => 'Ваше имя',
            'password' => 'Пароль',
            'city_id' => 'Город проживания',
            'created_at' => 'Created At',
        ];
    }

    public function registerUser()
    {
        $user = new User();

        $user->email = $this->email;
        $user->password = Yii::$app->security->generatePasswordHash($this->password);
        $user->save();

        $this->setUserInfo($user);
    }

    public function setUserInfo($user)
    {
        $user_info = new UserInfo();
        $user_info->user_id = $user->id;
        $user_info->name = $this->name;
        $user_info->city_id = $this->city_id;

        $user_info->save();
    }
}
