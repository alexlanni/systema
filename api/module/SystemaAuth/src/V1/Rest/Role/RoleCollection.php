<?php
namespace SystemaAuth\V1\Rest\Role;


use Systema\Paginator\PaginatorAbstract;

class RoleCollection extends PaginatorAbstract
{
    /** @var string $entityClass */
    protected string $entityClass = RoleEntity::class;
}
