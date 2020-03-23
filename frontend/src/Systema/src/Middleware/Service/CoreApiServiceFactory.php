<?php

namespace Systema\Middleware\Service;

use Psr\Container\ContainerInterface;

class CoreApiServiceFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $globalConfig = $container->get('config');
        return new CoreApiService($globalConfig['systema']);
    }

}