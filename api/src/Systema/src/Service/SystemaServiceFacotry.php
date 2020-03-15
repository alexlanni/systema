<?php


namespace Systema\Service;


class SystemaServiceFacotry
{
    public function __invoke($services)
    {
        $orm = $services->get('doctrine.entitymanager.orm_default');
        return new SystemaService($orm);
    }
}