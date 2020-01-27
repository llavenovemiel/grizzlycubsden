<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Messaging\Controller;

use Zend\Mail\Message;
use Zend\Http\Response;
use Zend\View\Model\JsonModel;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mvc\Controller\AbstractRestfulController;


class MessagingController extends AbstractRestfulController
{
    private $transport;
    private $appConfig;

    public function __construct($transport, $appConfig)
    {
        $this->transport = $transport;
        $this->appConfig = $appConfig;
    }

    public function get($data)
    {}

    public function create($data)
    {
        $data = json_decode($data);
        
        try {
            $mail = new Message();
            $mail->setSender($data->email,  $data->name);
            $mail->setReplyTo($data->email, $data->name);
            $mail->addTo($this->appConfig['companyContactMail'], 'Company');
            $mail->addCc($this->appConfig['companyTestContactMail'], 'Dev Mail');
            $messageHeader = $data->name . " with email: " . $data->email . ", has sent the following:";
            $mail->setSubject(htmlentities($data->subject));
            $mail->setBody($messageHeader . "\r\n\n" . htmlentities($data->message));
            $this->transport->send($mail);
            $success = true;
        } catch (\Exception $e) {
           $success = false;
        }
        
        if (!$success) {
            $this->getResponse()->setStatusCode(503);
        }

        return new JsonModel(['success' => $success]);        
    }
}
