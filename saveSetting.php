<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/15
 * Time: 9:56
 * Comment: 保存设置
 */

    require ("library/function.php");           //自定义函数
    require ("library/Db.class.php");           //连接数据库
    is_login();                                  //检测是否登录

    $db = new DB();                             //创建数据库实例
    $user_id = $_SESSION['user']['id'];         //从Session中获取用户id
    $sex = $_POST['sex'];
    $qq = $_POST['qq'];
    $email = $_POST['email'];
    $sql = "update zc_user set sex = :sex, qq = :qq, email = :email where id = :user_id";
    $update = $db->query($sql, array('user_id' => $user_id,'sex' => $sex, 'qq' => $qq, 'email' => $email));

    if ($update != false) {
        echo "<head><meta charset='UTF-8'></head>";
        echo "<script>layer.msg('保存成功'); window.location.href='setting.php';</script>";
    } else {
        echo "<head><meta charset='UTF-8'></head>";
        echo "<script>layer.msg('保存失败'); window.location.href='setting.php';</script>";
    }

