<?php


namespace TaskForce\Actions;


class DoneAction extends AbstractAction
{
    public function isAllowed(int $customer_id, int $developer_id, int $user_id):bool
    {
        return $customer_id === $user_id;
    }

    public function getName():string
    {
        return 'Выполнено';
    }

    public function getSlugName():string
    {
        return 'done';
    }
}
