<?php

namespace RBAC\Permissions;

class Resource implements IResource
{
    private $id = 0;
    private $name;
    private $resource;
    private $action = array();

    public function __construct($name, $resource)
    {
        $this->name = $name;
        $this->resource = $resource;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function setResource($resource)
    {
        $this->resouce = $resource;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction(IResource $action)
    {
        $this->action[] = $action;
    }
}
