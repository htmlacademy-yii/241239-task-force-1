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
            [['day', 'week', 'mouth', 'year'], 'safe']
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
            'month' => 'За месяц',
            'year' => 'За год'
        ];
    }

    public function applyFilters($queryTasks) {
        if (!empty($this->categories)) {
            $queryTasks->andWhere(['category_id' => $this->categories]);
        }

        if ($this->no_response) {
            $queryTasks->joinWith('responses r')->andWhere(['r.task_id' => null]);
        }

        if ($this->remote) {
           $queryTasks->andWhere(['task.city_id' => null]);
        }

        if ($this->search) {
            $queryTasks->andWhere(['like', 'task.name', $this->search]);
        }

        if ($this->period) {
            $queryTasks->andWhere(['>', 'task.created_at', date('Y-m-d H:i:s', strtotime("-1 {$this->period}")  )]);
        }
    }
}
