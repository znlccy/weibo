<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/13
 * Time: 13:02
 * Comment: 功能函数
 */

    /**
     * 调试
     * @param $data
     */
    function debug($data) {
        if ($data) {
            echo "<pre>";
            print_r($data);
        } else {
            echo "没有数据";
        }
    }

    /**
     * 获得字符串
     * @param int $id
     * @param int $level
     */
    function get_str($id = 0,$level = 0) {
        global $str;
        $sql = "select * from ";
    }

    /**
     * 检测是否登录，如果没有登录，调回首页
     */
    function is_login() {
        //开启session
        session_start();
        if (isset($_SESSION['user']['id']) && isset($_SESSION['user']['username'])) {
            return true;
        } else {
            echo "<script>window.location.href = 'login.php'</script>";
        }
    }

    /**
     * 判断是否收藏
     * @param $post_id
     */
    function is_collect($post_id) {

    }
?>