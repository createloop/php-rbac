<?php
namespace RBAC;

class Role
{
    private $name;
    private IPermissions $Permissions;

    public function __construct($name)
    {

    }

    public function getName()
    {
        return $this->name;
    }
}
