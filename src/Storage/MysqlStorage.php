<?php
namespace RBAC\Storage;
use \PDO;
use \Exception;

class MysqlStorageException extends Exception {}

class MysqlStorage extends AbstractStorage
{
    private $db;

    public static function getInstance(Array $conn = null)
    {
        if (static::$storage === null){
            static::$storage = new self($conn);
        }
        return static::$storage;
    }

    private function __construct($conn)
    {
        try {

            //有餵入pdo連線參數
            if ($conn != null) {
                $this->db = new PDO($conn['dsn'], $conn['account'], $conn['password']);
            } else {

                //走預設config
                $config = require_once 'config.php';
                $dsn = "mysql:host=".$config['host'].";"."dbname=".$config['dbname'];
                $this->db = new PDO($dsn, $config['account'], $config['password']);
            }
            $this->db->setAttribute( \PDO::ATTR_EMULATE_PREPARES, false );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {

            throw new MysqlStorageExceiption($e->getMessage());

        }


    }


    private function execute($sql, $val)
    {
        try {

            $sth = $this->db->prepare($sql);
            $sth->execute($val);
            return $sth;
        } catch (PDOException $e) {
            throw new MysqlStorageExceiption($e->getMessage());
        }

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

        $sth = $this->execute($sql, $val);
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



        $sth = $this->execute($sql, $val);

        return $sth->fetch(PDO::FETCH_ASSOC);


    }

    /**
    * 取得角色資源
    * @return array(array('name'=>, '' 'resource'=> '', action => ), array('name'=>, '' 'resource'=> '', action=>),...);
    *
    */
    public function getRoleResource($role_id)
    {
        $sql = "SELECT resource.name as name, resource.resource as resource, resource.id as id, roleresource.action as action  FROM roleresource
                INNER JOIN resource on roleresource.resource_id = resource.id
                WHERE roleresource.role_id = ?";

        $sth = $this->execute($sql, array($role_id));

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

        $sth = $this->execute($sql, array($user_id));

        return $result = $sth->fetchAll(PDO::FETCH_ASSOC);


    }

    /**
    * 新增角色
    */
    public function addRole($role_name)
    {
        $sql = "INSERT INTO role (name) value (?)";
        $sth = $this->execute($sql, array($role_name));
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
        $sql = "UPDATE role SET ".$set." where id = ?";

        $val[] = $role_id;
        $sth = $this->execute($sql, array($val));
    }

    public function addResource(Array $param)
    {
        $sql = "INSERT INTO resource (name, resource) value (?, ?)";
        $this->execute($sql, array($param['name'], $param['resource']));
    }

    public function setResource(Array $param, $resource_id)
    {
        foreach ($param as $key => $value) {
            $set[] = $key ."= ?";
            $val[] = $value;
        }
        $set = implode(" , ", $set);
        $sql = "UPDATE resource SET ".$set." where id = ?";
        $val[] = $resource_id;
        $this->execute($sql,  $val);
    }

    public function assignRole($role_id, $resource_id, $action)
    {
        $sql = "INSERT roleresource (role_id, resource_id, action) VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE action = VALUES(action)";
        $this->execute($sql,  array($role_id, $resource_id, $action));
    }

    public function unassignRole($role_id, $resource_id)
    {
        $sql = "DELETE roleresource WHERE role_id = ? AND resource_id = ?";
        $this->execute($sql,  array($role_id, $resource_id));
    }

    public function assignUser($user_id, $role_id)
    {
        $sql = "INSERT userrole (user_id, $role_id) VALUES (?, ?)";
        $this->execute($sql,  array($user_id, $role_id));
    }

    public function unassignUser($user_id, $role_id)
    {
        $sql = "DELETE userrole WHERE user_id = ? AND role_id = ?";
        $this->execute($sql,  array($user_id, $role_id));
    }
}
