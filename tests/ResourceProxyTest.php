<?php
use RBAC\Resource\Resource;
use RBAC\Storage\MysqlStorage;
use RBAC\ResourceProxy;
use RBAC\RoleProxy;
use RBAC\Rbac;
class ResourceProxyTest extends \PHPUnit_Framework_TestCase
{

    public function testGetAndSetName()
    {
        $storage = MysqlStorage::getInstance();
        $rp = new ResourceProxy('test', 'test/test', $storage);
        $this->assertEquals('test', $rp->getName());
        $rp->setName('test2');
        $this->assertEquals('test2', $rp->getName());

    }

    public function testGetAndSetResource()
    {
        $storage = MysqlStorage::getInstance();
        $rp = new ResourceProxy('test', 'test/test2', $storage);
        $this->assertEquals('test/test2', $rp->getResource());
        $rp->setResource('test/test3');
        $this->assertEquals('test/test3', $rp->getResource());

    }



}
