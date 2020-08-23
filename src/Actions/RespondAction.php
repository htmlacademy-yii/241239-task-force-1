<?php


namespace TaskForce\Actions;


class RespondAction extends AbstractAction
{
    public function isAllowed($customer_id, $developer_id, $user_id)
    {
        return $customer_id !== $user_id;
    }

    public function getName()
    {
        return 'Откликнуться';
    }

    public function getSlugName()
    {
        return 'respond';
    }
}
