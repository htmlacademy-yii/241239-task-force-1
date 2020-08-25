<?php

include_once '../../../vendor/autoload.php';

use TaskForce\Model\Task\Task;
use TaskForce\Actions\CancelAction;


$task = new Task(1, 2);

echo 'Done';
