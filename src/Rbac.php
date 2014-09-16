<?php

namespace RBAC;
use RBAC\interfaces;

class Rbac
{
    private $roles = array();
    private $user;

    public function __construct($user)
    {
        $this->user = $user; 
    }

    public function getUser()
    {
        return $this->user;
    }
    

    public function addRole(IRole $role)
    {
        $this->roles[$role->getName()] = $role;
    }

    public function removeRole($rolename)
    {
        unset($this->roles[$rolename]);
    }

    public function auth($resource, $action)
    {
        foreach ($this->roles as $role) {
            $rs = $role->getResources($resource);
            foreach ($rs as $value) {
                if ($value->isAction($action) {
                    
                    return true;
                }
            }
        }

        return false;

    }
}
