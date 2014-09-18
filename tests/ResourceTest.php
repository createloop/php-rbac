<?php
use RBAC\Resource\Resource;
use RBAC\Storage\MysqlStorage;
class ResourceTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAndSetName()
    {
        $a = new Resource('test', 'test/test', array('get'));
        $this->assertEquals('test', $a->getName());
        $a->setName('test2');
        $this->assertEquals('test2', $a->getName());

    }

    public function testGetAndSetResource()
    {
        $a = new Resource('test', 'test/test', array('get'));
        $this->assertEquals('test/test', $a->getResource());
        $a->setResource('test2/test2');
        $this->assertEquals('test2/test2', $a->getResource());
    }

    public function testAction()
    {
        $a = new Resource('test', 'test/test', array('get', 'post'));
        $this->assertEquals(array('get', 'post'), $a->getAction());
        $a->setAction(array('get', 'post', 'put'));

        $this->assertEquals(array('get', 'post' ,'put'), $a->getAction());

        $this->assertEquals(true, $a->isAction('get'));
        $this->assertEquals(false, $a->isAction('delete'));
        $this->assertEquals(true, $a->isAction('put'));
    }


}
