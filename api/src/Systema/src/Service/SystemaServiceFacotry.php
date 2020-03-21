<?php


namespace Systema\Service;


class SystemaServiceFacotry
{
    public function __invoke($services)
    {
        $orm = $services->get('doctrine.entitymanager.orm_default');
        $config = $services->get('config');
        $keyPath = $config['api-tools-mvc-auth']['authentication']['private_key'];
        $sessionTTL = $config['api-tools-mvc-auth']['authentication']['session_ttl'];
        return new SystemaService($orm, $keyPath,$sessionTTL);
    }
}