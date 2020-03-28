<?php

/**
 *
 * Definizione dell'entita LocalType
 *
 */

namespace Systema\V1\Rest\LocalType;

use Systema\Authorization\Interfaces\AssertOwnerInterface;

class LocalTypeEntity implements AssertOwnerInterface
{
    /** @var int $localTypeId */
    public $localTypeId;
    /** @var string $label */
    public $label;

    /**
     * LocalTypeEntity constructor.
     *
     * Il costruttore serve a spalmare i dati dell'Entita' Doctrine nelle proprieta' dell'Entita' REST
     *
     * @param null $object
     */
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


    public function setLoginId(): void
    {
        // TODO: Implement setLoginId() method.
    }

    public function getLoginId(): int
    {
        // TODO: Implement getLoginId() method.
    }

    /**
     * @inheritDoc
     */
    public function isAlwaysGranted(): bool
    {
        return true;
    }
}
