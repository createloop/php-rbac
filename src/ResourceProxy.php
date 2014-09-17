<?php

namespace RBAC;

use RBAC\Interfaces;

class ResourceProxy implements IResource
{
    private $realResource;
    private $id;
    private $storage;
    public function __construct($name, $resource, AbstractStorage $storage)
    {
        $this->storage = $storage;
        $resource = $this->storage->getResource(array('name' => $name, 'resource' => $resource));
        if ($resource === null) {
            $resource = $this->storage->addResource(array('name' => $name, 'resource' => $resource));
        }
        $this->id = $resource['id'];
        $this->realResource = new Resource($name, $resource, array());
    }

    public function getName()
    {
        $this->realResource->getName();
    }

    public function setName($name)
    {
        $this->storage->setResource(array('name' => $name),array('id' => $this->id));
        $this->realResource->setName($name);
    }

    public function getResource()
    {
        return $this->realResource->getResource();
    }

    public function setResource($resource)
    {
        $this->storage->setResource(array('resource' => $resource),array('id' => $this->id));
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

