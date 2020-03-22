<?php


namespace Systema\Entities\Repository;

use Doctrine\ORM\EntityRepository;

class Role extends EntityRepository
{

    /**
     * Ottine la Query per il FetchAll dei Role
     *
     * @param array $params
     * @return \Doctrine\ORM\Query
     */
    public function getFetchAllQuery($params=[])
    {
        $queryBuilder = $this->createQueryBuilder('ro');
        $queryBuilder->andWhere('1 = 1');
        if (!empty($params['roleId'])) {
            $queryBuilder->andWhere('ro.roleId = :roleId')
                ->setParameter('roleId', $params['roleId'], \PDO::PARAM_INT );
        }
        return $queryBuilder->getQuery();
    }

}