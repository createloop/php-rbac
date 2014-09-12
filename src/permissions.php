<?php

namespace RBAC;
use Permissions\Resource;

class Permissions implements IPermissions
{
    private $resourecs;
    private $resources_diff;

    public function __construct($resource = null)
    {
        $this->addResource($resource);     
    }

    public function addResource($resource)
    {
        if (is_array($key)) {
            foreach ($resource as $key => $value) {
                $this->resources[$key] = new Resource($key, $value);
            }
        }

    }

    public function removeResource($condition)
    {
        if (is_callable($search)) {
            foreach ($this->resources as $key => $value) {
                if ($search($key, $value)) {
                    unset($this->resources[$key]);
                }
            }
        }

    }

    public function __destruct()
    {
        if (count($resources_deiff) > 0) {
            $this->save();
        }
    }

    public function save()
    {
    }
}
