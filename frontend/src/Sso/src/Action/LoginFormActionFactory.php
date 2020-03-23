<?php

declare(strict_types=1);

namespace Sso\Action;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Systema\Middleware\Service\CoreApiService;

class LoginFormActionFactory
{
    public function __invoke(ContainerInterface $container) : LoginFormAction
    {
        $coreApiService = $container->get(CoreApiService::class);
        return new LoginFormAction($container->get(TemplateRendererInterface::class), $coreApiService);
    }
}
