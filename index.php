<?php
    require ("library/Db.class.php");       //连接数据库
    require ("library/function.php");       //自定义函数
    require ("library/Page.class.php");     //分页类

    is_login();                             //判断用户是否登录
    $db = new DB();                         //创建数据库实例
    
?>