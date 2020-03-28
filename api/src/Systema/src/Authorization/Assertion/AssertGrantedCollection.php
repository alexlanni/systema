<?php

namespace Systema\Authorization\Assertion;

use Laminas\Permissions\Rbac\AssertionInterface;
use Laminas\Permissions\Rbac\Rbac;
use Laminas\Permissions\Rbac\RoleInterface;

/**
 * Class AssertGrantedCollection
 * Permette a qualunque ruolo di accedere alla risorsa
 *
 * @package Systema\Authorization\Assertion
 */
class AssertGrantedCollection extends AssertCollectionOwner implements AssertionInterface
{
    protected $permissive = true;

    public function assert(Rbac $rbac, RoleInterface $role, string $permission): bool
    {
        return true;
    }
}
