<?php


namespace Systema\Service;


use Doctrine\ORM\EntityManager;
use Systema\Entities\LocalType;
use Systema\Entities\Role;
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
     * Ottine la Query per il FetchAll dei LocalType
     *
     * @param array $params
     * @return \Doctrine\ORM\Query
     */
    public function getFetchLocalTypesQuery($params=[])
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


    /**
     * Ottine la Query per il FetchAll dei Role
     *
     * @param array $params
     * @return \Doctrine\ORM\Query
     */
    public function getFetchAllRoleQuery($params=[])
    {
        $repoRoles = $this->getORM()->getRepository(Role::class);
        $queryBuilder = $repoRoles->createQueryBuilder('ro');
        $queryBuilder->andWhere('1 = 1');
        if (!empty($params['roleId'])) {
            $queryBuilder->andWhere('ro.roleId = :roleId')
                ->setParameter('roleId', $params['roleId'], \PDO::PARAM_INT );
        }
        return $queryBuilder->getQuery();
    }

}