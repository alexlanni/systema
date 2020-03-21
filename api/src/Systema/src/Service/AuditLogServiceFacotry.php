<?php

namespace Systema\Service;

class AuditLogServiceFacotry
{
    public function __invoke($services)
    {
        $orm = $services->get('doctrine.entitymanager.orm_default');
        $config = $services->get('config');
        return new AuditLogService($orm);
    }
}