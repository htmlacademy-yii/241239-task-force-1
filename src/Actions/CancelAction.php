<?php


namespace TaskForce\Actions;


class CancelAction extends AbstractAction
{
    public function isAllowed($customer_id, $developer_id, $user_id)
    {
        return $customer_id === $user_id;
    }

    public function getName()
    {
        return 'Отменить';
    }

    public function getSlugName()
    {
        return 'cancel';
    }
}
