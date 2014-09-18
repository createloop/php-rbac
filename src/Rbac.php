<?php

namespace RBAC;
use RBAC\interfaces;

class Rbac
{
    private $roles = array();
    private $userId;
    private $storage;

    public function __construct($userId, AbstractStorage $storage)
    {
        $this->$storage = $storage;
        $userRole = $this->$storage->getUserRole($userId);
        if (count($userRole) > 0) {
            foreach ($userRole as $value) {
                $this->addRole(new RoleProxy($value, $this->storage));
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
