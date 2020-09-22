<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_visit".
 *
 * @property int $id
 * @property int $user_visitor_id
 * @property int $user_guest_id
 *
 * @property User $userVisitor
 * @property User $userGuest
 */
class UserVisit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_visit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_visitor_id', 'user_guest_id'], 'required'],
            [['user_visitor_id', 'user_guest_id'], 'integer'],
            [['user_visitor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_visitor_id' => 'id']],
            [['user_guest_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_guest_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_visitor_id' => 'User Visitor ID',
            'user_guest_id' => 'User Guest ID',
        ];
    }

    /**
     * Gets query for [[UserVisitor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserVisitor()
    {
        return $this->hasOne(User::className(), ['id' => 'user_visitor_id']);
    }

    /**
     * Gets query for [[UserGuest]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserGuest()
    {
        return $this->hasOne(User::className(), ['id' => 'user_guest_id']);
    }
}
