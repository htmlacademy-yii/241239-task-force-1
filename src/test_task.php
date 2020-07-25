<?php

include_once 'Task.php';

use TaskForce\Task;

$task = new Task(1, 1);

assert($task->getNextStatus('cancel') == Task::STATUS_CANCEL, 'Cancel');

