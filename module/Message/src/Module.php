<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Message;

use Message\Model\Message;
use Message\Model\MessageTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Message\Controller\MessageController;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                MessageTable::class => function($container) {
                    $tableGateway = $container->get(Model\MessageTableGateway::class);
                    return new MessageTable($tableGateway);
                },
                Model\MessageTableGateway::class => function ($container) {
                    $dbAdapter = $container->get('grizzly-cubs-den');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Message());
                    return new TableGateway('messages', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                MessageController::class => function($container) {
                    return new MessageController(
                        $container->get(MessageTable::class)
                    );
                },
            ],
        ];
    }
}
