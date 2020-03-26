<?php


namespace Systema\Authorization\Assertion;

use Laminas\Permissions\Rbac\AssertionInterface;
use Laminas\Permissions\Rbac\Rbac;
use Laminas\Permissions\Rbac\RoleInterface;

class AssertOwner implements AssertionInterface
{
    protected int $loginId;
    protected $entity;


    public function __construct(int $loginId)
    {
        $this->loginId = $loginId;
    }

    /**
     * @param mixed $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

    /**
     * @inheritDoc
     */
    public function assert(Rbac $rbac, RoleInterface $role, string $permission): bool
    {
        if ($this->entity == null) {
            return false;
        }

        if (method_exists($this->entity, 'getLoginId')) {
            return false;
        }

        return ($this->loginId === $this->entity->getLoginId());
    }
}