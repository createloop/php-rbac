<?php

namespace RBAC;

use RBAC\Interfaces\IFactory;
use RBAC\Storage\AbstractStorage;
use RBAC\Role\Role;
use RBAC\Role\RoleProxy;
use RBAC\Resource\Resource;
use RBAC\Resource\ResourceProxy;

class Admin extends Base
{
    private $factory;

    public function __construct(IFactory $factory, AbstractStorage $storage)
    {
        parent::__construct($storage);
        $this->factory= $factory;
    }

    /**
     * 建立新的Resource 物件
     * @param  string $name
     * @param  string $resource
     * @return ResourceProxy
     */
    public function createResource($name, $resource)
    {
        $this->storage->addResource($name, $resource);
        return $factory->getResourceProxy($name, $resource, $this->storage);
    }

    /**
     * * 建立新的Role 物件
     * @param  string $role
     * @return RoleProxy
     */
    public function createRole($role)
    {
        $this->storage->addRole($role);
        return $factory->getRoleProxy($role, $this->storage);
    }

}
