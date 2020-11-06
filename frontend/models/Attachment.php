<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "attachment".
 *
 * @property int $id
 * @property int $task_id
 * @property string $url
 *
 * @property Task $task
 */
class Attachment extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attachment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'url'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'url' => 'Url',
        ];
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::class, ['id' => 'attach_uuid']);
    }

    public function upload()
    {
        if ($this->validate()) {

            $file = UploadedFile::getInstances($this, 'file');
            $name = 'uploads/' . $file->baseName . '.' . $file->extension;
            $file->saveAs($name);


            $this->url = $name;
            $this->save();


            return true;
        } else {
            return false;
        }
    }
}
