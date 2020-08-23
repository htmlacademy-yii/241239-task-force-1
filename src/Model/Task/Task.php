<?php


namespace TaskForce\Model\Task;


use TaskForce\Actions\CancelAction;

class Task
{
    const ROLE_DEVELOPER = 'developer';
    const ROLE_CUSTOMER = 'customer';

    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancel';
    const STATUS_WORK = 'work';
    const STATUS_DONE = 'done';
    const STATUS_FAIL = 'fail';

    const ACTION_DONE = 'done';
    const ACTION_CANCEL = 'cancel';
    const ACTION_FAIL = 'fail';
    const ACTION_REPLY = 'reply';

    const STATUS_NAME = [
        self::STATUS_NEW => 'Новое',
        self::STATUS_CANCEL => 'Отменено',
        self::STATUS_WORK => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAIL => 'Провалено',
    ];

    const ACTION_NAME = [
        self::ACTION_REPLY => 'Откликнуться',
        self::ACTION_CANCEL => 'Отменить',
        self::ACTION_DONE => 'Выполнено',
        self::ACTION_FAIL => 'Отказаться',
    ];

    const STATUS_MAP = [
        self::ACTION_REPLY => self::STATUS_WORK,
        self::ACTION_CANCEL => self::STATUS_CANCEL,
        self::ACTION_DONE => self::STATUS_DONE,
        self::ACTION_FAIL => self::STATUS_FAIL,
    ];

    const TASK_ROLE_MAP = [
        self::ROLE_CUSTOMER => 'Создатель',
        self::ROLE_DEVELOPER => 'Исполнитель'
    ];

    const ACTION_MAP = [
        self::ROLE_CUSTOMER => [
            self::STATUS_NEW => [CancelAction::class],
            self::STATUS_CANCEL => null,
            self::STATUS_WORK => [self::ACTION_DONE],
            self::STATUS_FAIL => null
        ],
        self::ROLE_DEVELOPER => [
            self::STATUS_NEW => [self::ACTION_REPLY],
            self::STATUS_CANCEL => null,
            self::STATUS_WORK => [self::ACTION_FAIL],
            self::STATUS_DONE => null,
            self::STATUS_FAIL => null,
        ]

    ];

    private $customer_id;
    private $developer_id;
    public $status;

    public function __construct($customer_id, $developer_id)
    {
        $this->customer_id = $customer_id;
        $this->developer_id = $developer_id;
    }

    public function getNextStatus($action)
    {
        if (in_array($action, self::STATUS_MAP)) {
            return self::STATUS_MAP[$action];
        }
    }

    public function getActions($status, $id)
    {
        if ($id == $this->customer_id) {
            return self::ACTION_MAP[self::ROLE_CUSTOMER];
        }
        return self::ACTION_MAP[self::ROLE_DEVELOPER];
    }

    public function getStatusMap()
    {
        return self::ACTION_NAME;
    }

    public function getActionMap()
    {
        return self::STATUS_NAME;
    }

    public function setStatus($status)
    {
        if (isset(self::STATUS_NAME[$status])) {
            $this->status = $status;
        }
    }
}
