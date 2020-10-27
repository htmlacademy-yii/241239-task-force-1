<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $surname
 * @property int $city_id
 * @property string|null $edited_at
 * @property string $date_birth
 * @property int $role_id
 * @property float|null $rating
 * @property string $phone
 * @property string $telegram
 * @property string $skype
 * @property string $bio
 *
 * @property UserCategory[] $userCategories
 * @property User $user
 * @property Cities $city
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'surname', 'city_id', 'date_birth', 'role_id', 'phone', 'telegram', 'skype'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'city_id' => 'City ID',
            'edited_at' => 'Edited At',
            'date_birth' => 'Date Birth',
            'role_id' => 'Role ID',
            'rating' => 'Rating',
            'phone' => 'Phone',
            'telegram' => 'Telegram',
            'skype' => 'Skype',
        ];
    }

    /**
     * Gets query for [[UserCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCategories()
    {
        return $this->hasMany(UserCategory::className(), ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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

    public function getTaskExecutorCount()
    {
        return $this->hasMany(Task::className(), ['executor_id' => 'user_id'])->count();
    }

    public function getReviews() {
        return $this->hasMany(Review::className(), ['user_id' => 'user_id']);
    }

    public function getReviewsCount() {
        return $this->getReviews()->count();
    }

    public function getUserCategory() {
        return $this->hasMany(Categories::className(), ['id' => 'category_id'])
            ->viaTable('user_category', ['user_id' => 'user_id']);
    }

    public function getPhotos()
    {
        return $this->hasMany(PortfolioPhoto::className(), ['user_id' => 'user_id']);
    }


}
