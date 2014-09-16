<?php
use RBAC;
class ResourceTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $a = new Resource('test', 'test/test', array('get'));
        $this->assertEquals('test', $a->getName());
    }
}
