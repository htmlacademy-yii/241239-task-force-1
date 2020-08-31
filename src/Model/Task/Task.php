<?php
declare(strict_types=1);

namespace TaskForce\Model\Task;

use TaskForce\Actions\CancelAction;
use TaskForce\Actions\DoneAction;
use TaskForce\Actions\FailAction;
use TaskForce\Actions\ReplyAction;
use TaskForce\Exceptions\TaskException;

class Task
{
    const ROLE_DEVELOPER = 'developer';
    const ROLE_CUSTOMER = 'customer';

    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancel';
    const STATUS_WORK = 'work';
    const STATUS_DONE = 'done';
    const STATUS_FAIL = 'fail';

    const STATUS_NAME = [
        self::STATUS_NEW => 'Новое',
        self::STATUS_CANCEL => 'Отменено',
        self::STATUS_WORK => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAIL => 'Провалено',
    ];

    const STATUS_MAP = [
        ReplyAction::class => self::STATUS_WORK,
        CancelAction::class => self::STATUS_CANCEL,
        DoneAction::class => self::STATUS_DONE,
        FailAction::class => self::STATUS_FAIL,
    ];

    const ACTION_MAP = [
        self::STATUS_NEW => [
            self::ROLE_DEVELOPER => ReplyAction::class,
            self::ROLE_CUSTOMER => CancelAction::class
        ],
        self::STATUS_WORK => [
            self::ROLE_CUSTOMER => DoneAction::class,
            self::ROLE_DEVELOPER => FailAction::class
        ],
        self::STATUS_CANCEL => null,
        self::STATUS_DONE => null,
        self::STATUS_FAIL => null,

    ];

    private $customer_id;
    private $developer_id;
    public $status;

    public function __construct(int $customer_id, int $developer_id, string $status)
    {
        if (!in_array($status, self::STATUS_MAP)) {
            throw new TaskException(`Нет такого статуса`);
        }

        $this->status = $status;

        $this->customer_id = $customer_id;
        $this->developer_id = $developer_id;
    }

    public function getNextStatus($action):string
    {
        if (array_key_exists($action, self::STATUS_MAP)) {
            return self::STATUS_MAP[$action];
        }
    }

    public function getUserStatus(int $id):?string
    {
        if ($id === $this->developer_id) {
            return self::ROLE_DEVELOPER;
        }
        if ($id === $this->customer_id) {
            return self::ROLE_CUSTOMER;
        }

        return null;
    }

    public function getAvailableActions(int $id):array
    {
        $next_actions = self::ACTION_MAP[$this->status];
        if (!$next_actions) {
            throw new TaskException('Нет доступных действий по этому статусу');
        }

        $available_actions = [];
        foreach ($next_actions as $next_action){
            $action = new $next_action();
            if($action->isAllowed($this->customer_id, $this->developer_id, $id)) {
                $available_actions[] = $action;
            }
        }

        return $available_actions;
    }

}
