<?php
use RBAC\Resource\Resource;
use RBAC\Storage\MysqlStorage;
use RBAC\ResourceProxy;
class ResourceProxyTest extends \PHPUnit_Framework_TestCase
{

    public function testConstruct()
    {
        $storage = MysqlStorage::getInstance();
        $a = new ResourceProxy('test', 'test/test', $storage);

    }


}
