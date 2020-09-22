<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "favorite_list".
 *
 * @property int $id
 * @property int $user_selected_id
 * @property int $user_who_select_id
 *
 * @property User $userSelected
 * @property User $userWhoSelect
 */
class FavoriteList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorite_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_selected_id', 'user_who_select_id'], 'required'],
            [['user_selected_id', 'user_who_select_id'], 'integer'],
            [['user_selected_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_selected_id' => 'id']],
            [['user_who_select_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_who_select_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_selected_id' => 'User Selected ID',
            'user_who_select_id' => 'User Who Select ID',
        ];
    }

    /**
     * Gets query for [[UserSelected]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserSelected()
    {
        return $this->hasOne(User::className(), ['id' => 'user_selected_id']);
    }

    /**
     * Gets query for [[UserWhoSelect]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserWhoSelect()
    {
        return $this->hasOne(User::className(), ['id' => 'user_who_select_id']);
    }
}
