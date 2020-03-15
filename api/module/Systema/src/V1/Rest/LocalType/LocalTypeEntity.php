<?php

/**
 *
 * EntityType
 *
 */

namespace Systema\V1\Rest\LocalType;

class LocalTypeEntity
{
    /** @var int $localTypeId */
    public $localTypeId;
    /** @var string $label */
    public $label;

    public function __construct($object=null)
    {
        if($object instanceof \Systema\Entities\LocalType)
        {
            $this->label = $object->getLabel();
            $this->localTypeId = $object->getLocalTypeId();
        }
    }

    /**
     * @return int
     */
    public function getLocalTypeId(): int
    {
        return $this->localTypeId;
    }

    /**
     * @param int $localTypeId
     * @return LocalTypeEntity
     */
    public function setLocalTypeId(int $localTypeId): LocalTypeEntity
    {
        $this->localTypeId = $localTypeId;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return LocalTypeEntity
     */
    public function setLabel(string $label): LocalTypeEntity
    {
        $this->label = $label;
        return $this;
    }


}
