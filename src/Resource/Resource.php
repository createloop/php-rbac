<?php

namespace RBAC\Resource;
use RBAC\Interfaces\IResource;

class Resource implements IResource
{
    private $name;
    private $resource;
    private $action = array();

    public function __construct($name, $resource, Array $action)
    {
        $this->name = $name;
        $this->resource = $resource;
        $this->action = array_unique($action);
        $this->is_new = true;
    }

    public function getId()
    {
        //空實作 主要是給Proxy實作
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction(Array $action)
    {
        $this->action = array_unique($this->action + $action);
    }

    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    public function isAction($action)
    {
        return in_array($action, $this->action);
    }


}
