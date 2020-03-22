<?php

declare(strict_types=1);

namespace Sso\Action;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class LoginFormActionFactory
{
    public function __invoke(ContainerInterface $container) : LoginFormAction
    {
        return new LoginFormAction($container->get(TemplateRendererInterface::class));
    }
}
