<?php
namespace SystemaAuth\V1\Rest\Login;

use Systema\Paginator\PaginatorAbstract;

class LoginCollection extends PaginatorAbstract
{
    /** @var string $entityClass */
    protected string $entityClass = LoginEntity::class;

}
