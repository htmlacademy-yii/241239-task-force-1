<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $slug
 * @property string $text
 *
 * @property Task[] $tasks
 */
class Status extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_CANCEL = 2;
    const STATUS_WORK = 3;
    const STATUS_DONE = 4;
    const STATUS_FAIL = 5;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'text'], 'required'],
            [['slug', 'text'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['text'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'text' => 'Text',
        ];
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['status_id' => 'id']);
    }
}
