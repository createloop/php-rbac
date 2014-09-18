<?php

namespace RBAC;
use RBAC\Interfaces\IResource;
use RBAC\Resource\Resource;
use RBAC\Storage\AbstractStorage;


class ResourceProxy implements IResource
{
    private $realResource;
    private $id = 0;
    private $storage;
    public function __construct($name, $resource, AbstractStorage $storage)
    {
        $this->storage = $storage;

        $rs = $this->storage->getResource(array('name' => $name, 'resource' => $resource));
        if (!$rs) {
            $rs = $this->storage->addResource(array('name' => $name, 'resource' => $resource));
        }
        $this->id = $rs['id'];


        $this->realResource = new Resource($name, $resource, array());
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        $this->realResource->getName();
    }

    public function setName($name)
    {
        $this->storage->setResource(array('name' => $name), $this->id);
        $this->realResource->setName($name);
        return self;
    }

    public function getResource()
    {
        return $this->realResource->getResource();
    }

    public function setResource($resource)
    {
        $this->storage->setResource(array('resource' => $resource), $this->id);
        $this->realResource->setResource($resource);
        return self;
    }

    public function getAction()
    {
        $this->realResource->getAction();
    }

    public function isAction($action)
    {
        $this->realResource->isAction($action);
    }

    public function setAction(Array $action)
    {
        $this->realResource->setAction($action);
        return self;
    }


}

