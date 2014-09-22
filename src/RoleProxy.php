<?php

namespace RBAC;
use RBAC\Interfaces\IRole;
use RBAC\Interfaces\IResource;
use RBAC\Role\Role;
use RBAC\Storage\AbstractStorage;
use \Exception;

class RoleProxyException extends Exception {}

class RoleProxy extends Base implements IRole
{
    private $realRole;
    private $id;


    public function __construct($name, AbstractStorage $storage)
    {
        parent::__construct($storage);

        //撈角色資料
        $role = $this->storage->getRole(array('name' => $name));

        //沒有資料 新建一筆
        if (!$role) {
            throw new RoleProxyException("NO RoleData");
        }
        $this->id = $role['id'];

        //角色實體指定
       $this->realRole = new Role($name);

        //撈角色下面的所有權限
        $roleResource = $this->storage->getRoleResource($role['id']);

        if ($roleResource) {
            foreach ($roleResource as $value) {
                try {
                    $resource = new ResourceProxy($value['name'], $value['resource'], $this->storage);

                    //從db assign 值給物件
                    $resource->setAction(explode("|", $value['action']));

                    //resource 推入
                    $this->addResource($resource);
                } catch (ResourceProxyException $e) {
                    throw new RoleProxyException("NO ResourceData");
                }

            }
        }

    }

    public function getId()
    {
        return $this->id;
    }

    public function getResources($resource = null)
    {
        return $this->realRole->getResources($resource);
    }

    public function addResource(IResource $resource)
    {
        $this->storage->assignRole($this->id, $resource->getId(), implode("|", $resource->getAction()));
        $this->realRole->addResource($resource);
    }

    public function removeResource($resourceName)
    {
        $this->storage->unassignRole($this->id, $resource->getId());
        $this->realRole->removeResource($resourceName);
    }

    public function setName($name)
    {
        $this->storage->setRole(array('name' => $name), array('id' => $this->id));
        $this->realRole->setName($name);

    }

    public function getName()
    {
        return $this->realRole->name;
    }
}
