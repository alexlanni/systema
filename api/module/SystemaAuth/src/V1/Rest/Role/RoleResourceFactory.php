<?php
namespace SystemaAuth\V1\Rest\Role;

use Systema\Service\SystemaService;

class RoleResourceFactory
{
    public function __invoke($services)
    {
        /** @var SystemaService $systemaSrv */
        $systemaSrv = $services->get(SystemaService::class);

        return new RoleResource($systemaSrv);
    }
}
