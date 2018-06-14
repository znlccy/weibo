<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/14
 * Time: 10:12
 */
    require("library/function.php");                        //自定义函数
    require ("library/Db.class.php");                       //连接数据库
    is_login();                                             //检测是否登录
    $db = new DB();                                         //连接数据库
    $user_id = $_SESSION['user']['id'];                     //获取用户id
    $sql = "select * from zc_user where id = :user_id";   //查询语句
    $user = $db->row($sql, array('user_id' => $user_id));  //填充绑定的参数

    include 'view/setting-list.php';                       //引入页面
?>