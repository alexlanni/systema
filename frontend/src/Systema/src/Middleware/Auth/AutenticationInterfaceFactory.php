<?php


namespace Systema\Middleware\Auth;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Systema\Middleware\Service\CoreApiService;

class AutenticationInterfaceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $globalConfig = $container->get('config');
        $coreApiService = $container->get(CoreApiService::class);
        return new AuthenticationAdapter(
            $container->get(TemplateRendererInterface::class),
            $globalConfig['systema'],
            $coreApiService
        );
    }
}