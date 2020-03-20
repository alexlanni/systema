<?php

namespace SystemaAuth\V1\Rest\Login;

class LoginEntity
{

    /** @var int $loginId */
    public int $loginId;

    /** @var string $email */
    public string $email;

    /** @var string $password */
    public string $password;

    /** @var int $enabled */
    public int $enabled;

    /**
     * RoleEntity constructor.
     * @param null $object
     */
    public function __construct($object=null)
    {
        if($object instanceof \Systema\Entities\Login)
        {
            $this->loginId = $object->getLoginId();
            $this->email = $object->getEmail();
            $this->password = $object->getPassword();
            $this->enabled = $object->isEnabled();
        }
    }



}
