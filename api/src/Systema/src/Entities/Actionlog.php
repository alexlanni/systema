<?php

namespace Systema\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actionlog
 *
 * @ORM\Table(name="actionlog")
 * @ORM\Entity
 */
class Actionlog
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="topic", type="string", length=255, nullable=false)
     */
    private $topic;

    /**
     * @var string
     *
     * @ORM\Column(name="verb", type="string", length=20, nullable=false)
     */
    private $verb;

    /**
     * @var string
     *
     * @ORM\Column(name="identity_type", type="string", length=20, nullable=false)
     */
    private $identityType;

    /**
     * @var string
     *
     * @ORM\Column(name="identity_role", type="string", length=20, nullable=false)
     */
    private $identityRole;

    /**
     * @var int
     *
     * @ORM\Column(name="identity_id", type="integer", nullable=false)
     */
    private $identityId;

    /**
     * @var string
     *
     * @ORM\Column(name="identity_token", type="string", length=255, nullable=false)
     */
    private $identityToken;

    /**
     * @var string
     *
     * @ORM\Column(name="client_ip", type="string", length=100, nullable=false)
     */
    private $clientIp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="client_ua", type="text", length=65535, nullable=true)
     */
    private $clientUa;

    /**
     * @var int
     *
     * @ORM\Column(name="response_http_status_code", type="integer", nullable=false)
     */
    private $responseHttpStatusCode;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Actionlog
     */
    public function setId(int $id): Actionlog
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Actionlog
     */
    public function setDate(\DateTime $date): Actionlog
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getTopic(): string
    {
        return $this->topic;
    }

    /**
     * @param string $topic
     * @return Actionlog
     */
    public function setTopic(string $topic): Actionlog
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * @return string
     */
    public function getVerb(): string
    {
        return $this->verb;
    }

    /**
     * @param string $verb
     * @return Actionlog
     */
    public function setVerb(string $verb): Actionlog
    {
        $this->verb = $verb;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentityType(): string
    {
        return $this->identityType;
    }

    /**
     * @param string $identityType
     * @return Actionlog
     */
    public function setIdentityType(string $identityType): Actionlog
    {
        $this->identityType = $identityType;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentityRole(): string
    {
        return $this->identityRole;
    }

    /**
     * @param string $identityRole
     * @return Actionlog
     */
    public function setIdentityRole(string $identityRole): Actionlog
    {
        $this->identityRole = $identityRole;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdentityId(): int
    {
        return $this->identityId;
    }

    /**
     * @param int $identityId
     * @return Actionlog
     */
    public function setIdentityId(int $identityId): Actionlog
    {
        $this->identityId = $identityId;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentityToken(): string
    {
        return $this->identityToken;
    }

    /**
     * @param string $identityToken
     * @return Actionlog
     */
    public function setIdentityToken(string $identityToken): Actionlog
    {
        $this->identityToken = $identityToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientIp(): string
    {
        return $this->clientIp;
    }

    /**
     * @param string $clientIp
     * @return Actionlog
     */
    public function setClientIp(string $clientIp): Actionlog
    {
        $this->clientIp = $clientIp;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getClientUa(): ?string
    {
        return $this->clientUa;
    }

    /**
     * @param string|null $clientUa
     * @return Actionlog
     */
    public function setClientUa(?string $clientUa): Actionlog
    {
        $this->clientUa = $clientUa;
        return $this;
    }

    /**
     * @return int
     */
    public function getResponseHttpStatusCode(): int
    {
        return $this->responseHttpStatusCode;
    }

    /**
     * @param int $responseHttpStatusCode
     * @return Actionlog
     */
    public function setResponseHttpStatusCode(int $responseHttpStatusCode): Actionlog
    {
        $this->responseHttpStatusCode = $responseHttpStatusCode;
        return $this;
    }

}
