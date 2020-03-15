<?php
namespace Systema\V1\Rest\LocalType;

use Laminas\Paginator\Paginator;

class LocalTypeCollection extends Paginator
{
    public function getCurrentItems()
    {
        $items = parent::getCurrentItems();

        $results = [];
        foreach ($items as $item)
        {
            $results[] = new LocalTypeEntity($item);
        }
        return new \ArrayIterator($results);
    }
}
