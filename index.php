<?php

include_once 'vendor/autoload.php';

use TaskForce\Model\Task\Task;
use TaskForce\Actions\CancelAction;
use TaskForce\Utils\DataLoader;

$data_converter = new DataLoader();
$data_converter->scanDirectory('./data');
$data_converter->toSql();


$task = new Task(1, 2, 'work');

assert($task->getUserStatus(1) === Task::ROLE_CUSTOMER);
assert($task->getNextStatus(CancelAction::class) === Task::STATUS_CANCEL);


echo 'Done';
