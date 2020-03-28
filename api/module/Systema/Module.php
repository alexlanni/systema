<?php
namespace Systema;

use Laminas\ApiTools\MvcAuth\MvcAuthEvent;
use Laminas\ApiTools\Provider\ApiToolsProviderInterface;
use Laminas\Mvc\ModuleRouteListener;
use Laminas\Mvc\MvcEvent;
use Systema\Authorization\AuthorizationDelegatorFactory;
use Systema\Authorization\AuthorizationListener;
use Systema\Authorization\RbacListener;
use Systema\Listener\AuditLogEvents;
use Systema\Service\AuditLogService;

class Module implements ApiToolsProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();

        // Event Listener
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        // Wire in our listener at priority >1 to ensure it runs before the
        // DefaultAuthorizationListener
        $eventManager->attach(
            MvcAuthEvent::EVENT_AUTHORIZATION_POST,
            new AuthorizationListener(),
            100
        );


        // Wire in our listener at priority >1 to ensure it runs before the
        // DefaultAuthorizationListener
        $eventManager->attach(
            MvcEvent::EVENT_RENDER,
            new RbacListener(),
            10
        );

        // Logger
        $alService = $e->getApplication()->getServiceManager()->get(AuditLogService::class);
        $alListener = new AuditLogEvents($alService);
        $alListener->attach(
            $eventManager
        );
    }

    public function getAutoloaderConfig()
    {
        return [
            'Laminas\ApiTools\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }
}
