<?php


namespace Systema\Authorization\Assertion;

use Laminas\Permissions\Rbac\Rbac;
use Laminas\Permissions\Rbac\RoleInterface;
use Systema\Authorization\AuthorizationService;

class AssertSessionOwner extends AssertOwner
{
    public function assert(Rbac $rbac, RoleInterface $role, string $permission): bool
    {
        if (
            $role->getName() == AuthorizationService::ROLE_ADMIN ||
            $role->getName() == AuthorizationService::ROLE_SUPERADMIN
        ) {
            return true;
        }

        if (!$this->preliminaryAssertions($rbac, $role, $permission)) {
            return false;
        }

        return ($this->loginId === $this->entity->getLoginId());
    }
}
