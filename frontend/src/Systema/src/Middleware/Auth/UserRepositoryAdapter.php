<?php

namespace Systema\Middleware\Auth;

use Mezzio\Authentication\UserInterface;
use Mezzio\Authentication\UserRepositoryInterface;

class UserRepositoryAdapter implements UserRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function authenticate(string $credential, string $password = null): ?UserInterface
    {
        // TODO: Implement authenticate() method.
    }
}