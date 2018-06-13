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

    //检验用户名和密码是否匹配
    $sql = "select * from zc_user where username = :username and password = :password";
    $db = new DB();
    $user = $db->row($sql, array('username' => $username, 'password' => md5($password)));
    if ($user) {
        $_SESSION['user'] = $user;
        echo 1;
    } else {
        echo -1;
    }
