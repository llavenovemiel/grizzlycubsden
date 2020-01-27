<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Messaging;

use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;
use Messaging\Controller\MessagingController;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    // public function getServiceConfig()
    // {
    //     return [];
    // }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                MessagingController::class => function($container) {
                    $transport = new Smtp();
                    $options   = new SmtpOptions([
                        'host'              => 'smtp.gmail.com',
                        'port'              => 587,
                        'connection_class'  => 'login',
                        'connection_config' => [
                            'username' => 'grizzlycubs.contactus@gmail.com',
                            'password' => 'cuqakxdqnpeyiqou',
                            'ssl'      => 'tls',
                        ],
                    ]);
                    $transport->setOptions($options);
                    $appConfig = $container->get('Config')['app'];
                    return new MessagingController($transport, $appConfig);
                },
            ],
        ];
    }
}
