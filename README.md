php-rbac
========
<br/>
<h3>安裝：</h3>
<code>
{
    "require": {
        "createloop/php-rbac": ">=5.4.0"

    }
}
</code>

<h3>設定：</h3>
<ol>
<li>可使用本身內建的Mysql，以PDO方式實現 <em>TODO::尚未實現外部注入dsn</em></li>
<li>可選擇自行實現儲存載體，只要繼承RBAC\Storage\AbstarctStroage
實作裡面的方法即可</li>
</ol>

<h3>使用：</h3>
