<?php


namespace frontend\models\forms;


use yii\base\Model;

class TaskForm extends Model
{
    public $categories;
    public $no_response;
    public $remote;
    public $period;
    public $search;

    public function rules()
    {
        return [
            [['categories', 'no_response', 'remote', 'period', 'search'], 'safe'],
            [['day', 'week', 'mouth'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'categories' => '',
            'no_response' => 'Без откликов',
            'remote' => 'Удалённо',
            'period' => 'Период',
            'search' => 'Поиск по названию'
        ];
    }

    public function attributeLabelsPeriod()
    {
        return [
            'day' => 'За день',
            'week' => 'За неделю',
            'month' => 'За месяц'
        ];
    }
}
