<?php

namespace RBAC\Storage;


/**
 * db 須繼承此界面
 *
 */
abstract class AbstractStorage
{
    /**
     * singleton
     */
    protected static $storage = null;

    /**
     * 取得儲存實體
     * @param  Array  array("dsn" => ..., "account" => ...., "password" => .....,)
     * @return AbstractStroage instance
     */
    abstract static function getInstance(Array $conn = null);


    abstract public function getAllResource();

    abstract public function getAllRole();

    /**
    * 取得資源
    * @param   array('key' => 'value');
    * @return  array('name' => test, 'resource' => 'test/test', 'id' => 5)
    */
    abstract public function getResource(Array $condition);

    /**
    * 取得角色
    * @param  array('key' => 'value');
    * @return roleName
    */
    abstract public function getRole(Array $condition);

    /**
    * 取得角色資源
    * @return array(array('name'=>, '' 'resource'=> ''), array('name'=>, '' 'resource'=> ''),...);
    *
    */
    abstract public function getRoleResource($role_id);

    /**
    * 取得使用者角色
    * @return array(roleName1,roleName2,roleName3)
    */
    abstract public function getUserRole($user_id);

    /**
    * 新增角色
    */
    abstract public function addRole($role_name);

    /**
    * 修改角色
    * @param array(coloum => value, ...)
    */
    abstract public function setRole(Array $param, $role_id);

    abstract public function addResource(Array $param);

    abstract public function setResource(Array $param, $resource_id);

    abstract public function assignRole($role_id, $resource_id, $action);

    abstract public function unassignRole($role_id, $resource_id);

    abstract public function assignUser($user_id, $role_id);

    abstract public function unassignUser($user_id, $role_id);

}
