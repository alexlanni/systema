<?php
namespace Systema\V1\Rest\LocalType;

use Systema\Service\SystemaService;

class LocalTypeResourceFactory
{
    public function __invoke($services)
    {
        $systemaSrv = $services->get(SystemaService::class);

        return new LocalTypeResource($systemaSrv);
    }
}
