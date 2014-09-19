php-rbac
========

Installation：
------

``` json
{
    "require": {
        "createloop/php-rbac": "*"
    }
}
```



Defautl Usage：
---------------
1. 把DB資料夾裡的sql 部屬在database （預設載體為Mysql，以PDO實現，要用不同儲存方式請看 *Custom Usage*）
2. 調整Storage/config.php 裡面的連線參數設定 或是 在MysqlStorage 裡 getInstance 時 帶入連線必要參數

Custom Usage：
---------------
1. 可選擇自行實現儲存載體，只要繼承RBAC\Storage\AbstarctStroage ，實作裡面的方法即可。


Usage:
------

驗證：

   ``` php
   $rbac = new Rbac("user_id", AbstractStorage storage);
   $rbac->auth("controller/action/resource","get"); //return true or false
   ```

建構新 resource：

    ``` php
    $resource = new ResourceProxy($name, $resource, AbstractStorage $storage);
    ```
建構新 Role：

    ``` php
    $role = new RoleProxy($name, AbstractStorage $storage);
    ```

賦予Role Resource：
    ``` php
    $role->addResource($resource);
    ```


License
-------

Composer is licensed under the MIT License - see the LICENSE file for details
