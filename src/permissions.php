<?php

namespace RBAC;
use Permissions\Resource;

class Permissions
{
    private $name;
    private $resourecs = array();
    private $resources_diff = array();

    public function __construct($name)
    {
        $this->name = $name;   
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * 增加resource
     * @param array( name => resource, ) 
     */
    public function addResource($resource)
    {
        if (is_array($key)) {
            foreach ($resource as $key => $value) {
                $this->resources[$key] = new Resource($key, $value);
            }
        }

    }

    /**
     * 移除resource
     * @param callback
     */
    public function removeResource($search)
    {
        if (is_callable($search)) {
            foreach ($this->resources as $key => $value) {
                if ($search($key, $value)) {
                    unset($this->resources[$key]);
                }
            }
        }

    }


    /**
     * 解構時執行回存
     */
    public function __destruct()
    {
        if (count($resources_deiff) > 0) {
            $this->save();
        }
    }

    /**
     * 把檢查resource異動 並做回存
     */
    public function save()
    {
    }
}
