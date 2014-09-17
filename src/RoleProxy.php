<?php

namespace RBAC;
use RBAC\Intefaces;

class RoleProxy implements IRole
{
    private $realRole;
    private $id;
    private $storage;
    public function __construct($name, AbstractStorage $storage)
    {
        $this->storage = $storage;
        $role = $this->storage->getRole(array('name' => $name));
        if ($role === null) {
            $role = $this->storage->addRole(array('name' => $name));
        }
        $this->realRole = new Role($name);
    }

    public function getId()
    {
        return $this->Id;
    }

    public function getResources($resource = null)
    {
        return $this->realRole->getResources($resource);
    }

    public function addResource(IResource $resource)
    {
        $this->storage->assignRole($this->id, $resource->getId(), $resource->getAction());
        $this->realRole->addResource($resource);
    }

    public function removeResource($resourceName)
    {
        $this->storage->unassignRole($this->id, $resource->getId());
        $this->realRole->removeResource($resourceName);
    }

    public function setName($name)
    {
        $this->storage->setRole(array('name' => $name), array('id' => $this->id));
        $this->realRole->setName($name);

    }
}
