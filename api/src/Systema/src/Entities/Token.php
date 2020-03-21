<?php

namespace Systema\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Token
 *
 * @ORM\Table(name="token", indexes={@ORM\Index(name="token_login_fk", columns={"login_id"})})
 * @ORM\Entity
 */
class Token
{
    /**
     * @var string
     *
     * @ORM\Column(name="token_id", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $tokenId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $creationDate = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="expire_date", type="datetime", nullable=true)
     */
    private $expireDate;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", length=0, nullable=false)
     */
    private $data;

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
     * @return string
     */
    public function getTokenId(): string
    {
        return $this->tokenId;
    }

    /**
     * @param string $tokenId
     * @return Token
     */
    public function setTokenId(string $tokenId): Token
    {
        $this->tokenId = $tokenId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     * @return Token
     */
    public function setCreationDate(\DateTime $creationDate): Token
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getExpireDate(): ?\DateTime
    {
        return $this->expireDate;
    }

    /**
     * @param \DateTime|null $expireDate
     * @return Token
     */
    public function setExpireDate(?\DateTime $expireDate): Token
    {
        $this->expireDate = $expireDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param string $data
     * @return Token
     */
    public function setData(string $data): Token
    {
        $this->data = $data;
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
     * @return Token
     */
    public function setLogin(Login $login): Token
    {
        $this->login = $login;
        return $this;
    }

}
