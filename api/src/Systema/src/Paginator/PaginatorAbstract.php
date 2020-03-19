<?php

/**
 * Abstract class per la gestione della confersione dei paginatori da Doctrine a Laminas
 *

 *
 */

namespace Systema\Paginator;


use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;

class PaginatorAbstract extends \Laminas\Paginator\Paginator
{
    /** @var string $entityClass Classe delle Entita' da Paginare */
    protected string $entityClass;

    /**
     * PaginatorAbstract constructor.
     * L'override consente di passare un oggetto di tipo \Doctrine\ORM\Query ed ottenerne il Paginator
     *
     * @param $adapter
     */
    public function __construct($adapter)
    {
        // Gestione Doctrine Query
        if ($adapter instanceof Query) $adapter = new DoctrinePaginator(new Paginator($adapter));

        parent::__construct($adapter);
    }


    /**
     * Override per gestione Entita' Custom
     *
     * @return \ArrayIterator|\Traversable
     * @throws \Exception
     */
    public function getCurrentItems()
    {
        $items = parent::getCurrentItems();

        if (is_null($this->entityClass)) throw new \Exception('No entityClass defined.');

        $results = [];
        foreach ($items as $item)
        {
            $results[] = new $this->entityClass($item);
        }

        return new \ArrayIterator($results);
    }
}