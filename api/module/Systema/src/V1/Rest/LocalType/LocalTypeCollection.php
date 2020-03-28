<?php
namespace Systema\V1\Rest\LocalType;

use Systema\Authorization\Interfaces\AssertOwnerInterface;
use Systema\Paginator\PaginatorAbstract;

class LocalTypeCollection extends PaginatorAbstract implements AssertOwnerInterface
{
    /** @var string $entityClass */
    protected string $entityClass = LocalTypeEntity::class;

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
        return true;
    }
}
