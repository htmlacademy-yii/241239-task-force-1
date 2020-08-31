<?php

namespace TaskForce\Actions;


class CancelAction extends AbstractAction
{
    public function isAllowed(int $customer_id, int $developer_id, int $user_id):bool
    {
        return $customer_id === $user_id;
    }

    public function getName():string
    {
        return 'Отменить';
    }

    public function getSlugName():string
    {
        return 'cancel';
    }
}
