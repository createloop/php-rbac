php-rbac
========

安裝：
------

``` json
{
    "require": {
        "createloop/php-rbac": "*"

    }
}
```
設定：
-----

<ol>
<li>可使用本身內建的Mysql，以PDO方式實現 <em>TODO::尚未實現外部注入dsn</em></li>
<li>可選擇自行實現儲存載體，只要繼承RBAC\Storage\AbstarctStroage
實作裡面的方法即可</li>
</ol>

使用：
------

License
-------

Composer is licensed under the MIT License - see the LICENSE file for details
