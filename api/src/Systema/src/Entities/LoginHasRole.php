<?php

namespace Systema\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * LoginHasRole
 *
 * @ORM\Table(name="login_has_role", indexes={@ORM\Index(name="login_has_role_index", columns={"login_id", "role_id"}), @ORM\Index(name="role_fk", columns={"role_id"}), @ORM\Index(name="IDX_249171AA5CB2E05D", columns={"login_id"})})
 * @ORM\Entity
 */
class LoginHasRole
{
    /**
     * @var int
     *
     * @ORM\Column(name="login_has_role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $loginHasRoleId;

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
    public function getLoginHasRoleId(): int
    {
        return $this->loginHasRoleId;
    }

    /**
     * @param int $loginHasRoleId
     * @return LoginHasRole
     */
    public function setLoginHasRoleId(int $loginHasRoleId): LoginHasRole
    {
        $this->loginHasRoleId = $loginHasRoleId;
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
     * @return LoginHasRole
     */
    public function setLogin(Login $login): LoginHasRole
    {
        $this->login = $login;
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
     * @return LoginHasRole
     */
    public function setRole(Role $role): LoginHasRole
    {
        $this->role = $role;
        return $this;
    }



}
