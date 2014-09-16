<?php
namespace RBAC;

class Role
{
    private $name;
    private $resources = array();

    public function __construct($name, Array $resources = array())
    {
        $this->name = name;
        $this->resouces = $resouces;
    }

    public function getName()
    {
        return $this->name;
    }

    public function addResource(IResource $resource)
    {
        $this->resources[] = $resource;
    }

    public function removeResource($resourceName)
    {
        foreach ($this->resources as $key => $resource) {
            if ($resource->getName() === $resourceName) {
                unset($resources[$key]);
            }
        }
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getResources($resource = null)
    { 
        $return = array();
        if (is_callabe($resource)) {
            foreach ($this->resources as $item) {
                if ($resource($item)) {
                    $return[] = $item;
                }
            }

            return $return;
        }
        
        if (is_string($resource) {
            foreach ($this->resource as $item) {
                if($item->getName() === $resource) {
                    $return[] = $item    
                }
            }

            return $return;
        }

        return $this->resources;
    } 
}
