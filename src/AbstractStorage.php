<?php

namespace RBAC;

/**
 * db 須繼承此界面
 *
 */
abstract class AbstratStorage
{
    /**
     * singleton
     */
    protected static $storage = null;

    public static function getInstance()
    {
        if ($storage === null){
            static::$storage = new self();
        }
        return static::$storage;
    }


   abstract public function getAllResource();

   abstract public function getAllRole();

   /**
    * 取得資源
    * @param array(coloum => value, ....)
    */
   abstract public function getResource(Array $param);

   /**
    * 取得角色
    * @param array(coloum => value, ....)
    * @return role | array(role1, role2, ....)
    */
   abstract public function getRole(Array $param);

   /**
    * 取得角色資源
    * @param array(coloum => value, ....)
    * @return array(
    *              array(
    *                  name => admin,
    *                  resource => array(
    *                                  name => operate,
    *                                  resource => operate/game,
    *                                  action => get|post,
    *                              ),
    *                              array(...),
    *              ),
    */
   abstract public function getRoleResource(Array $param);

   /**
    * 取得使用者角色
    * @param array(coloum => value, ...)
    * @return array(role1,role2,role3)
    */
   abstract public function getUserRole(Array $param);

   /**
    * 新增角色
    */
   abstract public function addRole(Array $param);

   /**
    * 修改角色
    * @param array(coloum => value, ...)
    */
   abstract public function setRole(Array $param, Array $condition);

   abstract public function addResource(Array $param);

   abstract public function setResource(Array $param, Array $condition);

   abstract public function assignRole($role_id, $resource_id, $action);

   abstract public function unassignRole($role_id, $resource_id);

   abstract public function assignUser($user_id, $role_id);

   abstract public function unassignUser($user_id, $role_id);

}
