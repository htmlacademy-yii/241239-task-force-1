<?php
//spl_autoload_register();

include_once 'Task.php';

use TaskForce\Task;

$task = new Task(1, 1);

assert($task->getStatus('cancel') == Task::STATUS_CANCEL, 'Cancel Status');

