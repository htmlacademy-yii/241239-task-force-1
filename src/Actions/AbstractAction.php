<?php


namespace TaskForce\Actions;


abstract class AbstractAction
{
    abstract public function isAllowed($customer_id, $developer_id, $user_id);

    abstract public function getName();

    abstract public function getSlugName();
}
