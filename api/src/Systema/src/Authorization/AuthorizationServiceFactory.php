<?php


namespace Systema\Authorization;

class AuthorizationServiceFactory
{
    public function __invoke($services)
    {
        /** @var SystemaService $systemaSrv */
        $config = $services->get('config');
        $authConfig = $config['api-tools-mvc-auth']['authorization'];
        $systemaAuthConfig = $config['systema-auth'];
        return new AuthorizationService($authConfig, $systemaAuthConfig);
    }
}