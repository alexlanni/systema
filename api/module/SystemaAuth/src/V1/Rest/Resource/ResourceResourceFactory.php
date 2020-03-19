<?php
namespace SystemaAuth\V1\Rest\Resource;

class ResourceResourceFactory
{
    public function __invoke($services)
    {
        return new ResourceResource();
    }
}
