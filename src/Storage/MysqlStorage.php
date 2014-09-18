<?php
namespace RBAC\Storage;
use \PDO;

class MysqlStorage extends AbstractStorage
{
    private $db;

    public static function getInstance()
    {
        if (static::$storage === null){
            static::$storage = new self();
        }
        return static::$storage;
    }

    private function __construct()
    {
        $dsn = "mysql:host=127.0.0.1;dbname=phprbac";
        $this->db = new PDO($dsn, 'root', '760804');
    }
    public function getAllResource()
    {
        $sql = "SELECT * FROM resource";
        $sth = $this->db->query($sql);

        return $sth->fetchAll;

    }

    public function getAllRole()
    {
        $sql = "SELECT * FROM role";
        $sth = $this->db->query($sql);

        return $sth->fetchAll();
    }

    /**
    * 取得資源
    * @param   array('key' => 'value');
    * @return  array('name' => test, 'resource' => 'test/test', 'id' => 5)
    */
    public function getResource(Array $condition)
    {
        foreach ($condition as $key => $value) {
            $where[] = $key ."= ?";
            $val[] = $value;
        }
        $where = implode(" AND ", $where);
        $sql = "SELECT * FROM resource WHERE ".$where." limit 1";

        $sth = $this->db->prepare($sql);
        $sth->execute($val);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
    * 取得角色
    * @param  array('key' => 'value');
    * @return roleName
    */
    public function getRole(Array $condition)
    {
        foreach ($condition as $key => $value) {
            $where[] = $key ."= ?";
            $val[] = $value;
        }
        $where = implode(" AND ", $where);
        $sql = "SELECT * FROM role WHERE ".$where." limit 1";
        $sth = $this->db->prepare($sql);
        $sth->execute($val);

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
    * 取得角色資源
    * @return array(array('name'=>, '' 'resource'=> ''), array('name'=>, '' 'resource'=> ''),...);
    *
    */
    public function getRoleResource($role_id)
    {
        $sql = "SELECT resource.name as name, resource.resource as resource, resource.id as id  FROM roleresource
                INNER JOIN resource on roleresource.resource_id = resource.id
                WHERE roleresource.role_id = ?";
        $sth = $this->db->prepare($sql);
        $sth->execute(array($role_id));
        return $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
    * 取得使用者角色
    * @return array(array('name'=>, '' 'id'=> ''), array('name'=>, '' 'id'=> ''),...)
    */
    public function getUserRole($user_id)
    {
        $sql = "SELECT role.id as id, role.name as name FROM userrole
                INNER JOIN role on userrole.role_id = role.id
                WHERE userrole.user_id = ?";
        $sth = $this->db->prepare($sql);
        $sth->execute(array($user_id));
        return $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
    * 新增角色
    */
    public function addRole($role_name)
    {
        $sql = "INSERT INTO role (name) value (?)";
        $sth = $this->db->prepare($sql);
        $sth->execute(array($role_name));
    }

    /**
    * 修改角色
    * @param array(coloum => value, ...)
    */
    public function setRole(Array $param, $role_id)
    {
        foreach ($condition as $key => $value) {
            $set[] = $key ."= ?";
            $val[] = $value;
        }
        $set = implode(" , ", $set);
        $sql = "UPDATE role ".$set." where id = ?";
        $sth = $this->db->prepare($sql);
        $val[] = $role_id;
        $sth->execute($val);
    }

    public function addResource(Array $param)
    {
        $sql = "INSERT INTO resource (name, resource) value (?, ?)";
        $sth = $this->db->prepare($sql);
        $sth->execute(array($param['name'], $param['resource']));
    }

    public function setResource(Array $param, $resource_id)
    {
        foreach ($condition as $key => $value) {
            $set[] = $key ."= ?";
            $val[] = $value;
        }
        $set = implode(" , ", $set);
        $sql = "UPDATE resource ".$set." where id = ?";
        $sth = $this->db->prepare($sql);
        $val[] = $resource_id;
        $sth->execute($val);
    }

    public function assignRole($role_id, $resource_id, $action)
    {
        $sql = "INSERT roleresource (role_id, $resource_id, action) VALUES (?, ?, ?)";
        $sth = $this->db->prepare($sql);
        $sth->execute(array($role_id, $resource_id, $action));
    }

    public function unassignRole($role_id, $resource_id)
    {
        $sql = "DELETE roleresource WHERE role_id = ? AND resource_id = ?";
        $sth = $this->db->prepare($sql);
        $sth->execute(array($role_id, $resource_id));
    }

    public function assignUser($user_id, $role_id)
    {
        $sql = "INSERT userrole (user_id, $role_id) VALUES (?, ?)";
        $sth = $this->db->prepare($sql);
        $sth->execute(array($user_id, $role_id));
    }

    public function unassignUser($user_id, $role_id)
    {
        $sql = "DELETE userrole WHERE user_id = ? AND role_id = ?";
        $sth = $this->db->prepare($sql);
        $sth->execute(array($user_id, $role_id));
    }
}
