<?php


namespace Systema\Middleware\Auth;

use Mezzio\Authentication\UserInterface;

class Session implements UserInterface
{

    private string $identity = '';

    private string $roles = '';

    private array $details = [];

    /**
     * @inheritDoc
     */
    public function getIdentity(): string
    {
        return $this->identity;
    }

    /**
     * @inheritDoc
     */
    public function getRoles(): iterable
    {
        return $this->roles;
    }

    /**
     * @inheritDoc
     */
    public function getDetail(string $name, $default = null)
    {
        if (isset($this->details[$name]))
            return $this->details[$name];
        else
            return $default;
    }

    /**
     * @inheritDoc
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * @param string $identity
     * @return Session
     */
    public function setIdentity(string $identity): Session
    {
        $this->identity = $identity;
        return $this;
    }

    /**
     * @param string $roles
     * @return Session
     */
    public function setRoles(string $roles): Session
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @param array $details
     * @return Session
     */
    public function setDetails(array $details): Session
    {
        $this->details = $details;
        return $this;
    }

}