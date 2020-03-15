<?php

namespace Systema\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Place
 *
 * @ORM\Table(name="place", indexes={@ORM\Index(name="place_type_id", columns={"place_type_id"})})
 * @ORM\Entity
 */
class Place
{
    /**
     * @var int
     *
     * @ORM\Column(name="place_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $placeId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false)
     */
    private $creationDate;

    /**
     * @var float
     *
     * @ORM\Column(name="lat", type="float", precision=10, scale=0, nullable=false)
     */
    private $lat;

    /**
     * @var float
     *
     * @ORM\Column(name="long", type="float", precision=10, scale=0, nullable=false)
     */
    private $long;

    /**
     * @var float
     *
     * @ORM\Column(name="extension", type="float", precision=10, scale=0, nullable=false, options={"default"="10"})
     */
    private $extension = '10';

    /**
     * @var \Systema\Entities\PlaceType
     *
     * @ORM\ManyToOne(targetEntity="Systema\Entities\PlaceType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="place_type_id", referencedColumnName="place_type")
     * })
     */
    private $placeType;



    /**
     * Get placeId.
     *
     * @return int
     */
    public function getPlaceId()
    {
        return $this->placeId;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Place
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set creationDate.
     *
     * @param \DateTime $creationDate
     *
     * @return Place
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate.
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set lat.
     *
     * @param float $lat
     *
     * @return Place
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat.
     *
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set long.
     *
     * @param float $long
     *
     * @return Place
     */
    public function setLong($long)
    {
        $this->long = $long;

        return $this;
    }

    /**
     * Get long.
     *
     * @return float
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * Set extension.
     *
     * @param float $extension
     *
     * @return Place
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension.
     *
     * @return float
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set placeType.
     *
     * @param \Systema\Entities\PlaceType|null $placeType
     *
     * @return Place
     */
    public function setPlaceType(\Systema\Entities\PlaceType $placeType = null)
    {
        $this->placeType = $placeType;

        return $this;
    }

    /**
     * Get placeType.
     *
     * @return \Systema\Entities\PlaceType|null
     */
    public function getPlaceType()
    {
        return $this->placeType;
    }
}
