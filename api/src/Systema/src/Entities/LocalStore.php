<?php

namespace Systema\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * LocalStore
 *
 * @ORM\Table(name="local_store", indexes={@ORM\Index(name="local_id", columns={"local_id"}), @ORM\Index(name="place_id", columns={"place_id"})})
 * @ORM\Entity
 */
class LocalStore
{
    /**
     * @var int
     *
     * @ORM\Column(name="local_store_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $localStoreId;

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
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=105, nullable=true)
     */
    private $address;

    /**
     * @var float|null
     *
     * @ORM\Column(name="lat", type="float", precision=10, scale=0, nullable=true)
     */
    private $lat;

    /**
     * @var float|null
     *
     * @ORM\Column(name="long", type="float", precision=10, scale=0, nullable=true)
     */
    private $long;

    /**
     * @var \Systema\Entities\Local
     *
     * @ORM\ManyToOne(targetEntity="Systema\Entities\Local")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="local_id", referencedColumnName="local_id")
     * })
     */
    private $local;

    /**
     * @var \Systema\Entities\Place
     *
     * @ORM\ManyToOne(targetEntity="Systema\Entities\Place")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="place_id", referencedColumnName="place_id")
     * })
     */
    private $place;



    /**
     * Get localStoreId.
     *
     * @return int
     */
    public function getLocalStoreId()
    {
        return $this->localStoreId;
    }

    /**
     * Set label.
     *
     * @param string $label
     *
     * @return LocalStore
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
     * @return LocalStore
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
     * Set address.
     *
     * @param string|null $address
     *
     * @return LocalStore
     */
    public function setAddress($address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set lat.
     *
     * @param float|null $lat
     *
     * @return LocalStore
     */
    public function setLat($lat = null)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat.
     *
     * @return float|null
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set long.
     *
     * @param float|null $long
     *
     * @return LocalStore
     */
    public function setLong($long = null)
    {
        $this->long = $long;

        return $this;
    }

    /**
     * Get long.
     *
     * @return float|null
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * Set local.
     *
     * @param \Systema\Entities\Local|null $local
     *
     * @return LocalStore
     */
    public function setLocal(\Systema\Entities\Local $local = null)
    {
        $this->local = $local;

        return $this;
    }

    /**
     * Get local.
     *
     * @return \Systema\Entities\Local|null
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * Set place.
     *
     * @param \Systema\Entities\Place|null $place
     *
     * @return LocalStore
     */
    public function setPlace(\Systema\Entities\Place $place = null)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place.
     *
     * @return \Systema\Entities\Place|null
     */
    public function getPlace()
    {
        return $this->place;
    }
}
