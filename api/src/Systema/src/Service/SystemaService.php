<?php


namespace Systema\Service;


use Doctrine\ORM\EntityManager;

class SystemaService
{

    private \Doctrine\ORM\EntityManager $orm;

    /**
     * PingResource constructor.
     * @param \Doctrine\ORM\EntityManager $orm
     */
    public function __construct(\Doctrine\ORM\EntityManager $orm)
    {
        $this->orm = $orm;
    }

    /**
     * Ritorna l'ORM utilizzato dal Servizio
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getORM(): EntityManager
    {
        return $this->orm;
    }



}