<?php

namespace RBAC;

use RBAC\Interfaces\IFactory;
use RBAC\Interfaces\IStorage;
use RBAC\Storage\AbstractStorage;
use RBAC\Role\Role;
use RBAC\Role\RoleProxy;
use RBAC\Resource\Resource;
use RBAC\Resource\ResourceProxy;


class ProxyFactory extends Base implements IFactory
{
    public function __construct(IStorage $storage)
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
