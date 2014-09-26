<?php

namespace RBAC\Interfaces;



/**
 * db 須繼承此界面
 *
 */
Interface IStorage
{


    /**
     * 取得儲存實體
     * @param  Array  array("dsn" => ..., "account" => ...., "password" => .....,)
     * @return AbstractStroage instance
     */
    /*function getInstance(Array $conn = null);*/


    function getAllResource();

    function getAllRole();

    /**
    * 取得資源
    * @param   array('key' => 'value');
    * @return  array('name' => test, 'resource' => 'test/test', 'id' => 5)
    */
    function getResource(Array $condition);

    /**
    * 取得角色
    * @param  array('key' => 'value');
    * @return roleName
    */
    function getRole(Array $condition);

    /**
    * 取得角色資源
    * @return array(array('name'=>, '' 'resource'=> ''), array('name'=>, '' 'resource'=> ''),...);
    *
    */
    function getRoleResource($role_id);

    /**
    * 取得使用者角色
    * @return array(roleName1,roleName2,roleName3)
    */
    function getUserRole($user_id);

    /**
    * 新增角色
    */
    function addRole($role_name);

    /**
    * 修改角色
    * @param array(coloum => value, ...)
    */
    function setRole(Array $param, $role_id);

    function addResource($name, $resource);

    function setResource(Array $param, $resource_id);

    function assignRole($role_id, $resource_id, $action);

    function unassignRole($role_id, $resource_id);

    function assignUser($user_id, $role_id);

    function unassignUser($user_id, $role_id);

}
