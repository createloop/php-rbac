<?php

namespace RBAC;
use RBAC\Storage\AbstractStorage;
use \Exception;

class RbacException extends Exception {}

class Rbac extends Base
{
    private $roles = array();
    private $userId;

    public function __construct($userId, AbstractStorage $storage)
    {
        parent::__construct($storage);
        $userRole = $this->storage->getUserRole($userId);

        if ($userRole) {
            foreach ($userRole as $value) {
                try {
                    $this->roles[] = new RoleProxy($value['name'], $this->storage);
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
