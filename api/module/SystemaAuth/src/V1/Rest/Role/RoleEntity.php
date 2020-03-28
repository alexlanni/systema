<?php
namespace SystemaAuth\V1\Rest\Role;

use Systema\Authorization\Interfaces\AssertOwnerInterface;

class RoleEntity implements AssertOwnerInterface
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
    public function __construct ($object=null)
    {
        if ($object instanceof \Systema\Entities\Role) {
            $this->roleId = $object->getRoleId();
            $this->label = $object->getLabel();
            $this->enabled = $object->isEnabled();
        }
    }

    public function setLoginId(): void
    {
        // TODO: Implement setLoginId() method.
    }

    public function getLoginId(): int
    {
        // TODO: Implement getLoginId() method.
    }

    /**
     * @inheritDoc
     */
    public function isAlwaysGranted(): bool
    {
        return true;
    }
}
