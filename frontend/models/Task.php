<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $status_id
 * @property string $att_id
 * @property int $price
 * @property int $category_id
 * @property int $author_id
 * @property int $executor_id
 * @property int $city_id
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $created_at
 * @property string|null $finished_at
 *
 * @property Attachment[] $attachments
 * @property Message[] $messages
 * @property Notification[] $notifications
 * @property Response[] $responses
 * @property Review[] $reviews
 * @property Categories $category
 * @property User $author
 * @property User $executor
 * @property Cities $city
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price', 'category_id', 'author_id'], 'required'],
            [['price', 'category_id', 'author_id', 'executor_id', 'city_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['created_at', 'finished_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['executor_id' => 'id']],
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
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'action' => 'Action',
            'price' => 'Price',
            'category_id' => 'Category ID',
            'author_id' => 'Author ID',
            'executor_id' => 'Executor ID',
            'city_id' => 'City ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'created_at' => 'Created At',
            'finished_at' => 'Finished At',
        ];
    }

    /**
     * Gets query for [[Attachments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttachments()
    {
        return $this->hasMany(Attachment::className(), ['attach_uuid' => 'att_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(UserInfo::className(), ['id' => 'author_id']);
    }

    public function getAuthorInfo()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Executor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::className(), ['id' => 'executor_id']);
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

    public function getResponsesCount()
    {
        return $this->getResponses()->count();
    }
}
