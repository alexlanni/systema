<?php
namespace SystemaAuth\V1\Rest\Role;


use Systema\Authorization\Interfaces\AssertOwnerInterface;
use Systema\Paginator\PaginatorAbstract;

class RoleCollection extends PaginatorAbstract implements AssertOwnerInterface
{
    /** @var string $entityClass */
    protected string $entityClass = RoleEntity::class;

    public function setLoginId(): void
    {
        // TODO: Implement setLoginId() method.
    }

    public function getLoginId(): int
    {
        return -1;
    }

    /**
     * @inheritDoc
     */
    public function isAlwaysGranted(): bool
    {
        return false;
    }
}
