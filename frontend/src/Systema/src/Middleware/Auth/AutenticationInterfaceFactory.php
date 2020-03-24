<?php


namespace Systema\Middleware\Auth;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AutenticationInterfaceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $globalConfig = $container->get('config');
        return new AuthAdapter($container->get(TemplateRendererInterface::class), $globalConfig['systema']);
    }
}