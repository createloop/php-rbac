<?php

namespace RBAC\Role;
use RBAC\Interface;

class instance implements IRole
{
    private $name;
    private $resource = array();


    public function __construct()
    {
    }
    public function getName()
    {
    }

    public function getResource()
    {
    }

    public function setResource(IResource $resource)
    {
    }

    public function setName()
    {
    }
}

