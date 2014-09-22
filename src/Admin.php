<?php

namespace RBAC;



class Admin extends Base
{
    private $storage;

    public function __construct(AbstractStorage $storage)
    {
        parent::__construct($storage);
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
        return new ResourceProxy($name, $resource, $this->storage);
    }

    /**
     * * 建立新的Role 物件
     * @param  string $role
     * @return RoleProxy
     */
    public function createRole($role)
    {
         $this->storage->addRole($name);
        return new RoleProxy($name, $resource, $this->storage);
    }

}
