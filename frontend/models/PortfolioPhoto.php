<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "portfolio_photo".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property string|null $created_at
 * @property int $rating
 *
 * @property User $user
 */
class PortfolioPhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'portfolio_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'description', 'url', 'rating'], 'required'],
            [['user_id', 'rating'], 'integer'],
            [['created_at'], 'safe'],
            [['title', 'description', 'url'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'title' => 'Title',
            'description' => 'Description',
            'url' => 'Url',
            'created_at' => 'Created At',
            'rating' => 'Rating',
        ];
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
}
