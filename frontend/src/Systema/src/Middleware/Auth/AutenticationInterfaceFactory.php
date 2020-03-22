<?php


namespace Systema\Middleware\Auth;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AutenticationInterfaceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new AuthAdapter($container->get(TemplateRendererInterface::class));
    }
}