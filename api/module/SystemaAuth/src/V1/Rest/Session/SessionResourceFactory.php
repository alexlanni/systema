<?php
namespace SystemaAuth\V1\Rest\Session;

use Systema\Service\SystemaService;

class SessionResourceFactory
{
    public function __invoke($services)
    {
        /** @var SystemaService $systemaSrv */
        $systemaSrv = $services->get(SystemaService::class);
        $config = $services->get('config');
        $sessionTTL = $config['api-tools-mvc-auth']['authentication']['session_ttl'];
        $keyPath = $config['api-tools-mvc-auth']['authentication']['private_key'];
        return new SessionResource($systemaSrv, $sessionTTL, $keyPath);
    }
}
