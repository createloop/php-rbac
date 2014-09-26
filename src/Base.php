<?php
namespace RBAC;

use RBAC\Interfaces\IStorage;

abstract class Base
{
    protected $storage;
    public function __construct(IStorage $storage)
    {
        $this->storage = $storage;
    }
}
