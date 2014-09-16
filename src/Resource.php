<?php

namespace RBAC;
use RBAC\Interfaces\IResource;

class Resource implements IResource
{
    private $id = 0;
    private $name;
    private $resource;
    private $action = array();
    private $is_change = false;
    private $is_new = false;

    public function __construct($name, $resource, Array $action)
    {
        $this->name = $name;
        $this->resource = $resource;
        $this->action = $action;
        $this->is_new = true;
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

    public function setAction($action)
    {
        $this->action = $action;
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
