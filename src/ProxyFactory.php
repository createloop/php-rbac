<?php

namespace RBAC;

use RBAC\Interfaces\IFactory;
use RBAC\Storage\AbstractStorage;

class ProxyFactory extends Base implements IFactory
{
    public function __construct(AbstractStorage $storage)
    {
        parent::__construct($storage);
        $this->storage = $storage;
    }

    public function getResourceProxy($resourceName, $resource)
    {
        return new ResourceProxy(new Resource($resourceName, $resource, array()), $this->storage);
    }

    public function getRoleProxy($roleName)
    {
        return new RoleProxy(new Role($roleName), $this->storage);
    }
}
