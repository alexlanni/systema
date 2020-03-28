<?php


namespace Systema\Authorization\Assertion;

use Laminas\Permissions\Rbac\AssertionInterface;
use Laminas\Permissions\Rbac\Rbac;
use Laminas\Permissions\Rbac\RoleInterface;

/**
 * Class AssertGrantedEntity
 *
 * @package Systema\Authorization\Assertion
 */
class AssertGrantedEntity extends AssertOwner implements AssertionInterface
{
    protected $permissive = true;

    public function assert(Rbac $rbac, RoleInterface $role, string $permission): bool
    {
        return true;
    }
}