<?php


namespace TaskForce\Actions;


abstract class AbstractAction
{
    abstract public function isAllowed(int $customer_id, int $developer_id, int $user_id):bool;

    abstract public function getName():string;

    abstract public function getSlugName():string;
}
