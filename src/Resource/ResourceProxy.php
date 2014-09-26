<?php

namespace RBAC\Resource;
use RBAC\Interfaces\IResource;
use RBAC\Interfaces\IStorage;
use RBAC\Resource\Resource;
use RBAC\Storage\AbstractStorage;
use RBAC\Base;
use \Exception;

class ResourceProxyException extends Exception {}

class ResourceProxy extends Base implements IResource
{
    private $realResource;

    private $id = 0;

    public function __construct(IResource $resource, IStorage $storage)
    {
        parent::__construct($storage);

        $rs = $this->storage->getResource(array('name' => $resource->getName(), 'resource' => $resource->getResource()));
        if (!$rs) {

            throw new ResourceProxyException("NO ResourceData");
        }
        $this->id = $rs['id'];


        $this->realResource = $resource;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->realResource->getName();
    }

    public function setName($name)
    {
        $this->storage->setResource(array('name' => $name), $this->id);
        $this->realResource->setName($name);
    }

    public function getResource()
    {
        return $this->realResource->getResource();
    }

    public function setResource($resource)
    {
        $this->storage->setResource(array('resource' => $resource), $this->id);
        $this->realResource->setResource($resource);
    }

    public function getAction()
    {
        return $this->realResource->getAction();
    }

    public function isAction($action)
    {
        return $this->realResource->isAction($action);
    }

    public function setAction(Array $action)
    {
        $this->realResource->setAction($action);
    }


}

