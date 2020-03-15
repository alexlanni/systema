<?php

namespace Systema\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Local
 *
 * @ORM\Table(name="local", indexes={@ORM\Index(name="local_type_id", columns={"local_type_id"})})
 * @ORM\Entity
 */
class Local
{
    /**
     * @var int
     *
     * @ORM\Column(name="local_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $localId;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255, nullable=false)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var \Systema\Entities\LocalType
     *
     * @ORM\ManyToOne(targetEntity="Systema\Entities\LocalType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="local_type_id", referencedColumnName="local_type_id")
     * })
     */
    private $localType;



    /**
     * Get localId.
     *
     * @return int
     */
    public function getLocalId()
    {
        return $this->localId;
    }

    /**
     * Set label.
     *
     * @param string $label
     *
     * @return Local
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

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Local
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set localType.
     *
     * @param \Systema\Entities\LocalType|null $localType
     *
     * @return Local
     */
    public function setLocalType(\Systema\Entities\LocalType $localType = null)
    {
        $this->localType = $localType;

        return $this;
    }

    /**
     * Get localType.
     *
     * @return \Systema\Entities\LocalType|null
     */
    public function getLocalType()
    {
        return $this->localType;
    }
}
