<?php

include_once '../../../vendor/autoload.php';

use TaskForce\Model\Task\Task;
use TaskForce\Actions\CancelAction;


$task = new Task(1, 2);

assert($task->getUserStatus(1) === Task::ROLE_CUSTOMER);
assert($task->getNextStatus(CancelAction::class) === Task::STATUS_CANCEL);


echo 'Done';
