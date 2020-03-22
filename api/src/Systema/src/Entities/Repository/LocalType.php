<?php


namespace Systema\Entities\Repository;

use Doctrine\ORM\EntityRepository;

class LocalType extends EntityRepository
{
    /**
     * Ottine la Query per il FetchAll dei LocalType
     *
     * @param array $params
     * @return \Doctrine\ORM\Query
     */
    public function getFetchQuery($params=[])
    {
        $queryBuilder = $this->createQueryBuilder('lt');
        $queryBuilder->andWhere('1 = 1');
        if (!empty($params['localTypeId'])) {
            $queryBuilder->andWhere('lt.localTypeId = :localTypeId')
                ->setParameter('localTypeId', $params['localTypeId'], \PDO::PARAM_INT );
        }
        return $queryBuilder->getQuery();
    }

}