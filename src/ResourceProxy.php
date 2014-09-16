<?php

namespace RBAC;

use RBAC\Interfaces;

class ResourceProxy implements IResource
{
    private $realResource;
    public function __construct($name, $resource, Array $action)
    {
        $this->realResource = new Resource($name, $resource, $action);
    }
    
    public function getName()
    {
        $this->realResource->getName();
    }

    public function setName($name)
    {
        $this->realResource->setName($name);
    }

    public function getResource()
    {
        return $this->realResource->getResource();
    }

    public function setResource($resource)
    {
        $this->realResource->setResource($resource);
    }

    public function getAction()
    {
        $this->realResource->getAction();
    }

    public function isAction($action)
    {
        $this->realResource->isAction($action);
    }

    public function setAction($action)
    {
        $this->realResource->setAction($action);
    }

}

