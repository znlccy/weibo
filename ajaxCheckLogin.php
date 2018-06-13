<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/13
 * Time: 13:08
 */
    session_start();                                //开启session
    require ('library/Db.class.php');              //连接数据库
    $username = $_POST['username'];                 //接收用户名
    $password = $_POST['password'];                 //接收密码

    //检验
