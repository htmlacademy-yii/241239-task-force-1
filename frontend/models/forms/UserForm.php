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
            $userQuery->joinWith('userCategories uc')->andWhere(['uc.category_id' => $this->categories]);
        }

        if ($this->online) {
            $userQuery->andWhere(['<=', 'last_activity', date('Y-m-d H:i:s', strtotime('+2 hour'))]);
        }

        if ($this->free) {
            $userQuery->joinWith('tasks t')->andWhere(['t.executor_id' => null]);
        }

        if ($this->reviews) {
            $userQuery->joinWith('reviews r')->andWhere(['not', ['r.user_id' => null]]);
        }

        if ($this->in_favorite) {
            $userQuery->joinWith('favoriteLists fl')->andWhere(['fl.user_selected_id' => null]);
        }

        if ($this->search) {
            $userQuery->andWhere(['like', 'name', $this->search]);
        }
    }
}
