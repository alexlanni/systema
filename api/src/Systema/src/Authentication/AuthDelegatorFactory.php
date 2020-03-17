<?php


namespace Systema\Authentication;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\DelegatorFactoryInterface;

class AuthDelegatorFactory implements DelegatorFactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        $listener  = $callback();
        $listener->attach($container->get(\Systema\Authentication\AuthAdapter::class));
        return $listener;
    }
}