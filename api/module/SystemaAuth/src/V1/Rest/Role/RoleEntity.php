<?php
namespace SystemaAuth\V1\Rest\Role;

class RoleEntity
{

    /** @var int $roleId */
    public int $roleId;

    /** @var string $label */
    public string $label;

    /** @var bool $enabled */
    public bool $enabled;


    /**
     * RoleEntity constructor.
     * @param null $object
     */
    public function __construct($object=null)
    {
        if($object instanceof \Systema\Entities\Role)
        {
            $this->roleId = $object->getRoleId();
            $this->label = $object->getLabel();
            $this->enabled = $object->isEnabled();
        }
    }

}
