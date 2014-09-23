<?php
use RBAC\Storage\MysqlStorage;
use RBAC\Rbac;
use RBAC\ProxyFactory;

class RbacTest extends \PHPUnit_Framework_TestCase
{
    protected $rbac;
    public function setUp()
    {
        $storage = MysqlStorage::getInstance();
        $this->rbac = new Rbac(1, new ProxyFactory($storage), $storage);
    }

    public function testAuth()
    {
        $this->assertEquals(true, $this->rbac->auth("test/test", "get"));
    }
}
