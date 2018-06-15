<?php

    require ("library/Db.class.php");           //引入数据库文件
    require ("library/function.php");           //引入自定义函数库
    is_login();                                  //判断是否登录

    $db = new DB();                             //实例化数据库类
    $old_password = md5($_POST['old_password']);//获取原始密码
    $new_password = md5($_POST['new_password']);//获取新密码
    $user_id = $_SESSION['user']['id'];         //获取用户id

    $sql = "select password from zc_user where id = :user_id";
    $password = $db->single($sql, array('user_id' => $user_id));

    //更新密码
    if ($old_password == $password) {           //判断输入两次新密码是否一致
        $update_sql = "update zc_user set password = :newPassword where id =:user_id";
        $update = $db->query($update_sql, array('user_id' => $user_id, 'newPassword' => $new_password));
        if ($update) {
            echo 1;                             //更改成功
        } else {
            echo 0;                             //更改失败
        }
    } else {
        echo -1;                                //原始密码错误
    }
?>