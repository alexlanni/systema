<?php

namespace Systema\Entities;

/**
 * Login
 *
 * @ORM\Table(name="login", uniqueConstraints={@ORM\UniqueConstraint(name="login_email_uindex", columns={"email"})})
 * @ORM\Entity
 */
class Login
{
    /**
     * @var int
     *
     * @ORM\Column(name="login_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $loginId;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=150, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled = '0';

    /**
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="login_has_role",
     *     joinColumns={@ORM\JoinColumn(name="login_id", referencedColumnName="login_id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="role_id")}
     * )
     */
    private $roles;

    /**
     * @return int
     */
    public function getLoginId(): int
    {
        return $this->loginId;
    }

    /**
     * @param int $loginId
     * @return Login
     */
    public function setLoginId(int $loginId): Login
    {
        $this->loginId = $loginId;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Login
     */
    public function setEmail(string $email): Login
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Login
     */
    public function setPassword(string $password): Login
    {
        $this->password = $password;
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
     * @return Login
     */
    public function setEnabled(bool $enabled): Login
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return Role[]
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     * @return Login
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

}
