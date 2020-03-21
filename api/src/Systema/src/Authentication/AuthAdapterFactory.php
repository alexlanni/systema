<?php


namespace Systema\Authentication;


use Systema\Service\SystemaService;

class AuthAdapterFactory
{
    public function __invoke($services)
    {
        /** @var SystemaService $systemaSrv */
        $systemaSrv = $services->get(SystemaService::class);
        $config = $services->get('config');
        $keyPath = $config['api-tools-mvc-auth']['authentication']['private_key'];
        $sessionTTL = $config['api-tools-mvc-auth']['authentication']['session_ttl'];
        return new AuthAdapter($systemaSrv, $sessionTTL, $keyPath);
    }
}