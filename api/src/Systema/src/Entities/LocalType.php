<?php

namespace Systema\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * LocalType
 *
 * @ORM\Table(name="local_type")
 * @ORM\Entity(repositoryClass="Systema\Entities\Repository\LocalType")
 */
class LocalType
{
    /**
     * @var int
     *
     * @ORM\Column(name="local_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $localTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=45, nullable=false)
     */
    private $label;



    /**
     * Get localTypeId.
     *
     * @return int
     */
    public function getLocalTypeId()
    {
        return $this->localTypeId;
    }

    /**
     * Set label.
     *
     * @param string $label
     *
     * @return LocalType
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
}
