<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/13
 * Time: 13:02
 * Comment: 用户退出功能
 */

    session_start();                                                //开启Session
    unset($_SESSION['user']);                                      //清除Session
    $result_dest = session_destroy();                               //销毁Session
    if ($result_dest) {
        echo "<script>window.location.href='login.php'</script>";  //跳转到登录页面
    } else {
        echo "退出失败";
    }
?>