<?php

declare(strict_types=1);

namespace App\Action;

use Laminas\Authentication\AuthenticationService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Systema\Middleware\Auth\AuthenticationAdapter;

class UserWelcomeActionFactory
{
    public function __invoke(ContainerInterface $container) : UserWelcomeAction
    {
        return new UserWelcomeAction($container->get(TemplateRendererInterface::class));
    }
}
