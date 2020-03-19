<?php
namespace Systema\V1\Rest\LocalType;

use Systema\Paginator\PaginatorAbstract;

class LocalTypeCollection extends PaginatorAbstract
{
    /** @var string $entityClass */
    protected string $entityClass = LocalTypeEntity::class;
}
