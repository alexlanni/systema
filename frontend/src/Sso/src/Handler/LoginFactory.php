<?php

declare(strict_types=1);

namespace Sso\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class LoginFactory
{
    public function __invoke(ContainerInterface $container) : Login
    {
        return new Login($container->get(TemplateRendererInterface::class));
    }
}
