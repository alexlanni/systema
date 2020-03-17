<?php


namespace Systema\Authentication;


class AuthAdapterFactory
{
    public function __invoke($services)
    {
        return new AuthAdapter();
    }
}