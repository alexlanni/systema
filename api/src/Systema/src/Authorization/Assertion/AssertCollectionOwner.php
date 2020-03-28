<?php


namespace Systema\Authorization\Assertion;

use Laminas\ApiTools\MvcAuth\Identity\AuthenticatedIdentity;
use Laminas\Permissions\Rbac\AssertionInterface;
use Laminas\Permissions\Rbac\Rbac;
use Laminas\Permissions\Rbac\RoleInterface;
use Systema\Authorization\AuthorizationService;

class AssertCollectionOwner implements AssertionInterface
{
    protected int $loginId;
    protected AuthenticatedIdentity $identity;
    protected $collection;
    protected $permissive = false;


    public function __construct(AuthenticatedIdentity $identity)
    {
        $this->identity = $identity;
        $this->loginId =  $identity->getAuthenticationIdentity()->getLoginId();
    }

    /**
     * @param mixed $collection
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }

    protected function preliminaryAssertions(Rbac $rbac, RoleInterface $role, string $permission): bool
    {
        // Gestione della modalita' Permissive
        if ($this->permissive) {
            return true;
        }

        // Verifiche Preliminari
        if ($this->collection == null) {
            return false;
        }

        if (
            $role->getName() == AuthorizationService::ROLE_ADMIN ||
            $role->getName() == AuthorizationService::ROLE_SUPERADMIN
        ) {
            return true;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function assert(Rbac $rbac, RoleInterface $role, string $permission): bool
    {
        if (!$this->preliminaryAssertions($rbac, $role, $permission)) {
            return false;
        }

        // TODO:


        //return ($this->loginId === $this->entity->getLoginId());
    }
}