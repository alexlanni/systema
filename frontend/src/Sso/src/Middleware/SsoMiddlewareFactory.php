<?php

declare(strict_types=1);

namespace Sso\Middleware;

use Psr\Container\ContainerInterface;

class SsoMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : SsoMiddleware
    {
        return new SsoMiddleware();
    }
}
