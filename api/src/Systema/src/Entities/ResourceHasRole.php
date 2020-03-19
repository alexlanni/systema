<?php

namespace Systema\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResourceHasRole
 *
 * @ORM\Table(name="resource_has_role", indexes={@ORM\Index(name="rhr_role_fk", columns={"role_id"}), @ORM\Index(name="rhr_resource_fk", columns={"resource_id"})})
 * @ORM\Entity
 */
class ResourceHasRole
{
    /**
     * @var int
     *
     * @ORM\Column(name="resource_has_role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $resourceHasRoleId;

    /**
     * @var \Systema\Entities\Resource
     *
     * @ORM\ManyToOne(targetEntity="Systema\Entities\Resource")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource_id", referencedColumnName="resource_id")
     * })
     */
    private $resource;

    /**
     * @var \Systema\Entities\Role
     *
     * @ORM\ManyToOne(targetEntity="Systema\Entities\Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     * })
     */
    private $role;

    /**
     * @return int
     */
    public function getResourceHasRoleId(): int
    {
        return $this->resourceHasRoleId;
    }

    /**
     * @param int $resourceHasRoleId
     * @return ResourceHasRole
     */
    public function setResourceHasRoleId(int $resourceHasRoleId): ResourceHasRole
    {
        $this->resourceHasRoleId = $resourceHasRoleId;
        return $this;
    }

    /**
     * @return Resource
     */
    public function getResource(): Resource
    {
        return $this->resource;
    }

    /**
     * @param Resource $resource
     * @return ResourceHasRole
     */
    public function setResource(Resource $resource): ResourceHasRole
    {
        $this->resource = $resource;
        return $this;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @param Role $role
     * @return ResourceHasRole
     */
    public function setRole(Role $role): ResourceHasRole
    {
        $this->role = $role;
        return $this;
    }

}
