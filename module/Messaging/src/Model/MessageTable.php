<?php

namespace Message\Model;

use Zend\Db\TableGateway\TableGateway;

class MessageTable
{
    private $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getMessage($messageId)
    {
        $message = $this->tableGateway->select(['id' => $messageId])->current();
        return $message;
    }

    public function getAllMessages()
    {
        // refactor this method by taking only needed data for display in page
        // $messages = 'working endpoint';
        // $messages = $this->tableGateway->select();
        return $this->tableGateway->select();

        // print_r($messages);
        // exit;

        // return $messages;
    }

    public function saveMessage(array $messageDetails)
    {
        $this->tableGateway->insert($messageDetails);
        return $this->tableGateway->getLastInsertValue();
    }

    public function updateMessageStatus($status, $messageId)
    {
        return $this->tableGateway->update(['status' => $status], ['cart_id' => $cartId]);
    }

}