<?php


namespace frontend\models\forms;


use yii\base\Model;

class UserForm extends Model
{
    public $categories;
    public $online;
    public $reviews;
    public $in_favorite;
    public $free;
    public $search;

    public function rules()
    {
        return [
          [['categories', 'online', 'reviews', 'in_favorite', 'free', 'search'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'categories' => '',
            'online' => 'Сейчас онлайн',
            'free' => 'Сейчас свободен',
            'reviews' => 'Есть отзывы',
            'in_favorite' => 'В избранном',
            'search' => 'Поиск по имени'
        ];
    }
}
