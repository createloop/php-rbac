<?php

namespace RBAC;
use RBAC\Storage\AbstractStorage;
use RBAC\Interfaces\IFactory;
use RBAC\Role\RoleProxy;
use RBAC\Resource\ResourceProxy;
use \Exception;

class RbacException extends Exception {}

class Rbac extends Base
{
    private $roles = array();
    private $userId;

    public function __construct($userId, IFactory $factory, AbstractStorage $storage)
    {
        parent::__construct($storage);
        $userRole = $this->storage->getUserRole($userId);

        if ($userRole) {

            //先撈有哪些角色
            foreach ($userRole as $value) {

                try {

                    $roleProxy = $factory->getRoleProxy($value['name'], $this->storage);
                    $roleResource = $this->storage->getRoleResource($roleProxy->getId());
                    if ($roleResource) {

                        //從角色找尋有哪些resource
                        foreach ($roleResource as $resourceValue) {
                            try {
                                $resource = $factory->getResourceProxy($resourceValue['name'], $resourceValue['resource'], $this->storage);

                                //從db assign 值給物件
                                $resource->setAction(explode("|", $resourceValue['action']));

                                //resource 推入
                                $roleProxy->addResource($resource);
                            } catch (ResourceProxyException $e) {
                                throw new RoleProxyException("NO ResourceData");
                            }

                        }
                    }

                    $this->roles[] = $roleProxy;

                } catch (RoleProxyException $e) {

                    throw new RbacException("NO RoleProxyData");
                }

            }
        }

        $this->userId = $userId;

    }


    public function getUser()
    {
        return $this->userId;
    }

    public function auth($resource, $action)
    {
        foreach ($this->roles as $role) {
            $rs = $role->getResources($resource);
            foreach ($rs as $value) {
                if ($value->isAction($action)) {

                    return true;
                }
            }
        }

        return false;

    }
}
