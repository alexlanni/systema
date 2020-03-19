<?php
namespace SystemaAuth\V1\Rest\Session;

class SessionResourceFactory
{
    public function __invoke($services)
    {
        return new SessionResource();
    }
}
