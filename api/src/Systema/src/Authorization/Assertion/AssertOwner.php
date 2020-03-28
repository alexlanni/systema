<?php


namespace Systema\Authorization\Assertion;

use Laminas\ApiTools\MvcAuth\Identity\AuthenticatedIdentity;
use Laminas\Permissions\Rbac\AssertionInterface;
use Laminas\Permissions\Rbac\Rbac;
use Laminas\Permissions\Rbac\RoleInterface;
use Systema\Authorization\AuthorizationService;

class AssertOwner implements AssertionInterface
{
    protected int $loginId;
    protected AuthenticatedIdentity $identity;
    protected $entity;
    protected $permissive = false;


    public function __construct(AuthenticatedIdentity $identity)
    {
        $this->identity = $identity;
        $this->loginId =  $identity->getAuthenticationIdentity()->getLoginId();
    }

    /**
     * @param mixed $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

    protected function preliminaryAssertions(Rbac $rbac, RoleInterface $role, string $permission): bool
    {
        // Gestione della modalita' Permissive
        if ($this->permissive) {
            return true;
        }

        // Verifiche Preliminari
        if ($this->entity == null) {
            return false;
        }

        // Se non esiste il metodo, non posso verificare la ownership
        if (!method_exists($this->entity, 'getLoginId')) {
            error_log('No getLoginId method defined in entity ' . get_class($this->entity));
            return false;
        }

        if (
            $role->getName() == AuthorizationService::ROLE_ADMIN ||
            $role->getName() == AuthorizationService::ROLE_SUPERADMIN
        ) {
            return true;
        }
    }

    /**
     * @inheritDoc
     */
    public function assert(Rbac $rbac, RoleInterface $role, string $permission): bool
    {
        if (!$this->preliminaryAssertions($rbac, $role, $permission)) {
            return false;
        }

        return ($this->loginId === $this->entity->getLoginId());
    }
}