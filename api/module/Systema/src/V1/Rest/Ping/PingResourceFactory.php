<?php
namespace Systema\V1\Rest\Ping;

class PingResourceFactory
{
    public function __invoke($services)
    {
        $orm = $services->get("doctrine.entitymanager.orm_default");

        return new PingResource($orm);
    }
}
