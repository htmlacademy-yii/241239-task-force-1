<?php


namespace TaskForce\Actions;


class FailAction extends AbstractAction
{
    public function isAllowed(int $customer_id, int $developer_id, int $user_id):bool
    {
        return $developer_id === $user_id;
    }

    public function getName():string
    {
        return 'Отказаться';
    }

    public function getSlugName():string
    {
        return 'fail';
    }
}
