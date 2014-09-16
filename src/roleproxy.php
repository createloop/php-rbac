<?php

namespace RBAC;
use RBAC\Intefaces;

class RoleProxy implements IRole
{
    private $realRole;

    public function __construct($name, Array $resources = array())
    {
        $this->realRole = new Role($name, $resource);
    }

    public function getResources($resource = null)
    {
        return $this->realRole->getResources($resource);
    }

    public function addResource(IResource $resource)
    {
        $this->realRole->addResource($resource);
    }

    public function removeResource($resourceName)
    {
        $this->realRole->removeResource($resourceName);
    }

    public function setName($name)
    {
        $this->realRole->setName($name);

    }
} 
