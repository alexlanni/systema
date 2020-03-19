<?php

namespace Systema\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address", indexes={@ORM\Index(name="address_login_fk", columns={"login_id"})})
 * @ORM\Entity
 */
class Address
{
    /**
     * @var int
     *
     * @ORM\Column(name="address_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $addressId;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=10, nullable=false)
     */
    private $zipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="province", type="string", length=10, nullable=false)
     */
    private $province;

    /**
     * @var string
     *
     * @ORM\Column(name="country_code", type="string", length=4, nullable=false, options={"default"="IT"})
     */
    private $countryCode = 'IT';

    /**
     * @var \Systema\Entities\Login
     *
     * @ORM\ManyToOne(targetEntity="Systema\Entities\Login")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="login_id", referencedColumnName="login_id")
     * })
     */
    private $login;

    /**
     * @return int
     */
    public function getAddressId(): int
    {
        return $this->addressId;
    }

    /**
     * @param int $addressId
     * @return Address
     */
    public function setAddressId(int $addressId): Address
    {
        $this->addressId = $addressId;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Address
     */
    public function setAddress(string $address): Address
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     * @return Address
     */
    public function setZipcode(string $zipcode): Address
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * @param string $province
     * @return Address
     */
    public function setProvince(string $province): Address
    {
        $this->province = $province;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     * @return Address
     */
    public function setCountryCode(string $countryCode): Address
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @return Login
     */
    public function getLogin(): Login
    {
        return $this->login;
    }

    /**
     * @param Login $login
     * @return Address
     */
    public function setLogin(Login $login): Address
    {
        $this->login = $login;
        return $this;
    }




}
