<?php

declare(strict_types=1);

namespace Sso\Action;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ProcessLoginActionFactory
{
    public function __invoke(ContainerInterface $container) : ProcessLoginAction
    {
        return new ProcessLoginAction($container->get(TemplateRendererInterface::class));
    }
}
