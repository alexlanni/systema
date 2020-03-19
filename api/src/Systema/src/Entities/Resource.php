<?php

namespace Systema\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resource
 *
 * @ORM\Table(name="resource", uniqueConstraints={@ORM\UniqueConstraint(name="resource_index", columns={"name", "verb"})})
 * @ORM\Entity
 */
class Resource
{
    /**
     * @var int
     *
     * @ORM\Column(name="resource_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $resourceId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="verb", type="string", length=15, nullable=true)
     */
    private $verb;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false, options={"default"="1"})
     */
    private $enabled = true;

    /**
     * @return int
     */
    public function getResourceId(): int
    {
        return $this->resourceId;
    }

    /**
     * @param int $resourceId
     * @return Resource
     */
    public function setResourceId(int $resourceId): Resource
    {
        $this->resourceId = $resourceId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Resource
     */
    public function setName(string $name): Resource
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVerb(): ?string
    {
        return $this->verb;
    }

    /**
     * @param string|null $verb
     * @return Resource
     */
    public function setVerb(?string $verb): Resource
    {
        $this->verb = $verb;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return Resource
     */
    public function setEnabled(bool $enabled): Resource
    {
        $this->enabled = $enabled;
        return $this;
    }



}
