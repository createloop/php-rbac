<?php

namespace RBAC;
use RBAC\Intefaces\IRole;
use RBAC\Role\Role;

class RoleProxy implements IRole
{
    private $realRole;
    private $id;
    private $storage;
    public function __construct($name, AbstractStorage $storage)
    {
        $this->storage = $storage;

        //撈角色資料
        $role = $this->storage->getRole(array('name' => $name));

        //沒有資料 新建一筆
        if ($role === null) {
            $role = $this->storage->addRole($name);
        }
        $this->id = $role['id'];

        //角色實體指定
        $this->realRole = new Role($name);

        //撈角色下面的所有權限
        $roleResource = $this->storage->getRoleResource(array('role_id' => $role['id']));
        if (count($roleResouce) > 0) {
            foreach ($roleResource as $value) {
                $this->addResource(new ResourceProxy($value['name'], $value['resource'], $this->storage));
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
        $this->storage->assignRole($this->id, $resource->getId(), $resource->getAction());
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
}
