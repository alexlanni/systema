<?php
namespace SystemaAuth\V1\Rest\Login;

use Systema\Service\SystemaService;

class LoginResourceFactory
{
    public function __invoke($services)
    {
        /** @var SystemaService $systemaSrv */
        $systemaSrv = $services->get(SystemaService::class);

        return new LoginResource($systemaSrv);
    }
}
