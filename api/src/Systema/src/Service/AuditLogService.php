<?php


namespace Systema\Service;

use Doctrine\ORM\EntityManager;

class AuditLogService
{

    protected EntityManager $orm;

    /**
     *
     * @param \Doctrine\ORM\EntityManager $orm
     */
    public function __construct(\Doctrine\ORM\EntityManager $orm)
    {
        $this->orm = $orm;
    }

}