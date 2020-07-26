<?php

include_once '../vendor/autoload.php';

use TaskForce\Task\Task;

$task = new Task(1, 2);

assert($task->getNextStatus('cancel') == Task::STATUS_CANCEL, 'Cancel');
assert($task->getActions(Task::STATUS_WORK, 2) == Task::ACTION_MAP[Task::ROLE_DEVELOPER], 'Developers Action');

echo 'Done';
