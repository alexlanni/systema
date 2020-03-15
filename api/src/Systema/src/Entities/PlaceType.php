<?php

namespace Systema\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlaceType
 *
 * @ORM\Table(name="place_type")
 * @ORM\Entity
 */
class PlaceType
{
    /**
     * @var int
     *
     * @ORM\Column(name="place_type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $placeType;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=105, nullable=false)
     */
    private $label;



    /**
     * Get placeType.
     *
     * @return int
     */
    public function getPlaceType()
    {
        return $this->placeType;
    }

    /**
     * Set label.
     *
     * @param string $label
     *
     * @return PlaceType
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
