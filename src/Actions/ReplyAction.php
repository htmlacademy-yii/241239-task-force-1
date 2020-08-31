<?php


namespace TaskForce\Actions;


class ReplyAction extends AbstractAction
{
    public function isAllowed(int $customer_id, int $developer_id, int $user_id):bool
    {
        return $customer_id !== $user_id;
    }

    public function getName():string
    {
        return 'Откликнуться';
    }

    public function getSlugName():string
    {
        return 'respond';
    }
}
