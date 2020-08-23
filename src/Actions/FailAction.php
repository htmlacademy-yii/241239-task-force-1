<?php


namespace TaskForce\Actions;


class FailAction extends AbstractAction
{
    public function isAllowed($customer_id, $developer_id, $user_id)
    {
        return $developer_id === $user_id;
    }

    public function getName()
    {
        return 'Отказаться';
    }

    public function getSlugName()
    {
        return 'fail';
    }
}
