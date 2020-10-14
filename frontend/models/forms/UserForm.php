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
            'online' => 'Сейчас онлайн',
            'free' => 'Сейчас свободен',
            'reviews' => 'Есть отзывы',
            'in_favorite' => 'В избранном',
            'search' => 'Поиск по имени'
        ];
    }

    public function getMoreAttribute() {
        return [
            'online' => 'Сейчас онлайн',
            'free' => 'Сейчас свободен',
            'reviews' => 'Есть отзывы',
            'in_favorite' => 'В избранном',
        ];
    }

    public function applyFilters($userQuery) {
        if (!empty($this->categories)) {
            $userQuery->joinWith(['userCategories'])
                ->where(['category_id' => 2]);
        }

        if ($this->online) {

        }

        if ($this->search) {
            $userQuery->andWhere(['like', 'name', $this->search]);
        }
    }
}
