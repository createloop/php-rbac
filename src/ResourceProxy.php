<?php

namespace RBAC;
use RBAC\Interfaces\IResource;
use RBAC\Resource\Resource;
use RBAC\Storage\AbstractStorage;
use \Exception;

class ResourceProxyException extends Exception {}

class ResourceProxy extends Base implements IResource
{
    private $realResource;
    private $id = 0;
    public function __construct($name, $resource, AbstractStorage $storage)
    {
        parent::__construct($storage);

        $rs = $this->storage->getResource(array('name' => $name, 'resource' => $resource));
        if (!$rs) {

            throw new ResourceProxyException("NO ResourceData");
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

