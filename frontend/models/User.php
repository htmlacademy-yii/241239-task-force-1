<?php

namespace frontend\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property int $city_id
 * @property string|null $created_at
 *
 * @property FavoriteList[] $favoriteLists
 * @property FavoriteList[] $favoriteLists0
 * @property Message[] $messages
 * @property Notification[] $notifications
 * @property PortfolioPhoto[] $portfolioPhotos
 * @property Response[] $responses
 * @property Review[] $reviews
 * @property SiteSettings[] $siteSettings
 * @property Task[] $tasks
 * @property Task[] $tasks0
 * @property Cities $city
 * @property UserInfo[] $userInfos
 * @property UserVisit[] $userVisits
 * @property UserVisit[] $userVisits0
 */
class User extends \yii\db\ActiveRecord
{
    const DEVELOPER_ROLE = 2;
    const CUSTOMER_ROLE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'city_id', 'name'], 'required'],
            [['city_id'], 'integer'],
            [['created_at'], 'safe'],
            [['email', 'password'], 'string', 'max' => 255],
            [['email'], 'unique'],
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

    /**
     * Gets query for [[FavoriteLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoriteLists()
    {
        return $this->hasMany(FavoriteList::className(), ['user_selected_id' => 'id']);
    }

    /**
     * Gets query for [[FavoriteLists0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoriteLists0()
    {
        return $this->hasMany(FavoriteList::className(), ['user_who_select_id' => 'id']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[PortfolioPhotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortfolioPhotos()
    {
        return $this->hasMany(PortfolioPhoto::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[SiteSettings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSiteSettings()
    {
        return $this->hasMany(SiteSettings::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['author_id' => 'id']);
    }


    public function getTasksCount()
    {
        return $this->getTasks()->count();
    }

    /**
     * Gets query for [[Tasks0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasksExecutor()
    {
        return $this->hasMany(Task::className(), ['executor_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[UserInfos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserInfos()
    {
        return $this->hasOne(UserInfo::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserVisits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserVisits()
    {
        return $this->hasMany(UserVisit::className(), ['user_visitor_id' => 'id']);
    }

    /**
     * Gets query for [[UserVisits0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserVisits0()
    {
        return $this->hasMany(UserVisit::className(), ['user_guest_id' => 'id']);
    }

    public function getCountTasks() {
        return $this->getTasksExecutor()->count();
    }

    public function getUserReviews() {
        return $this->getReviews()->count();
    }

    public function getUserCategory() {
        return $this->hasMany(Categories::className(), ['id' => 'category_id'])
                    ->viaTable('user_category', ['user_id' => 'id']);
    }

    public function getUserCategories() {
        return $this->hasMany(UserCategory::className(), ['user_id' => 'id']);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($this->password);
    }
}
