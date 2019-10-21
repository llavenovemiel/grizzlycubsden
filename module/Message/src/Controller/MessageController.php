<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Message\Controller;

use Zend\View\Model\JsonModel;
use Message\Model\MessageTable;
use Zend\View\Model\ViewModel;  
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\AbstractRestfulController;

class MessageController extends AbstractRestfulController
{
    private $MessageTable;

    public function __construct(MessageTable $MessageTable)
    {
        $this->MessageTable = $MessageTable;
    }

    public function create($data)
    {
        $this->MessageTable->saveMessage($data);
        return new JsonModel(['response' => $data]);
    }

    public function getList()
    {
        $messages = $this->MessageTable->getAllMessages();
        $messagesArray = array();

        foreach ($messages as $message) {
            $messagesArray[] = $message;
        }

        return new JsonModel(['messages' => $messagesArray]);
    }

    public function get($id)
    {
        $message = $this->MessageTable->getMessage($id);
        return new JsonModel(['messages' => $message]);
    }
}
