<?php


namespace Systema\Service;


use Doctrine\ORM\EntityManager;
use Systema\Entities\LocalType;
use function PHPUnit\Framework\isEmpty;

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

    /**
     * Ottiene Query del FetchAll
     *
     * @param array $params
     * @return \Doctrine\ORM\Query
     */
    public function fetchAllLocalType($params=[])
    {
        $localTypeRepo = $this->getORM()
            ->getRepository(LocalType::class);
        $queryBuilder = $localTypeRepo->createQueryBuilder('lt');
        $queryBuilder->andWhere('1 = 1');
        if (!empty($params['localTypeId'])) {
            $queryBuilder->andWhere('lt.localTypeId = :localTypeId')
            ->setParameter('localTypeId', $params['localTypeId'], \PDO::PARAM_INT );
        }
        return $queryBuilder->getQuery();
    }



}