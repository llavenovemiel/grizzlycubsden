<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Message;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'message' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/message[/:id]',
                    'defaults' => [
                        'controller' => Controller\MessageController::class,
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            
        ],
    ],
    'view_manager' => [
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ],
];
