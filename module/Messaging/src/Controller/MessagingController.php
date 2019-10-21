<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Messaging\Controller;

use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail\Message;


class MessagingController extends AbstractRestfulController
{

    public function __construct()
    {}

    public function get($data)
    {
        $mail = new Message();
        $mail->setBody('This is the text of the email.');
        $mail->setSender('llavenovemiel1@gmail.com', 'Vim Test');
        $mail->setReplyTo('llavenovemiel1@gmail.com', 'Vim Test');
        $mail->setSender('llavenovemiel1@gmail.com', 'Vim Test');
        $mail->addTo('llavenovemiel@gmail.com', 'Name of recipient');
        $mail->setSubject('TestSubject');


        // inject mail transport to controller
        $transport = new SmtpTransport();
        $options   = new SmtpOptions([
            'host'              => 'smtp.gmail.com',
            'port'              => 587,
            'connection_class'  => 'login',
            'connection_config' => [
                'username' => 'llavenovemiel@gmail.com',
                'password' => 'kzdnrrahqxmpdiif',
                'ssl'      => 'tls',
            ],
        ]);
        $transport->setOptions($options);

        
        $transport->send($mail);

        return new JsonModel(['response' => 'success']);
    }

    public function create($data)
    {}

    public function getList()
    {   
        return new JsonModel(['response' => 'sucess']);
    }

}
