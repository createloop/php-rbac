<?php
namespace RBAC;

use RBAC\Storage\AbstractStorage;

abstract class Base
{
    protected $storage;
    public function __construct(AbstractStorage $storage)
    {
        $this->storage = $storage;
    }
}
