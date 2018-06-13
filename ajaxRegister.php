<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/13
 * Time: 18:41
 */
    require ('library/Db.class.php');       //连接数据库
    $username = $_POST['username'];          //获取用户名
    $password = $_POST['password'];          //获取密码

    echo 1;
    //判断用户名是否存在
    $db = new DB();
    $sql = "select username from zc_user where username = :username";
    $name = $db->row($sql, array('username' => $username));

    //如果在数据库中已经存在这个用户了，则告诉用户已经注册了
    if ($name) {
        echo -1;
        exit();
    }

    //当前时间戳
    $addtime = time();
    $insert_sql = "insert into zc_user(username, password, addtime) value (:username, :password, $addtime)";
    $insert_id = $db->query($insert_sql, array('username' => $username, 'password' => md5($password)));
    //注册成功
    if ($insert_id) {
        echo 1;
    } else {
        echo 0;
    }
