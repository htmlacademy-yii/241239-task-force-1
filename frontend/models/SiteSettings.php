<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "site_settings".
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $new_message
 * @property int|null $actions_in_task
 * @property int|null $show_contacts_client
 * @property int|null $show_profile
 *
 * @property User $user
 */
class SiteSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'site_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'new_message', 'actions_in_task', 'show_contacts_client', 'show_profile'], 'integer'],
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
            'new_message' => 'New Message',
            'actions_in_task' => 'Actions In Task',
            'show_contacts_client' => 'Show Contacts Client',
            'show_profile' => 'Show Profile',
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
