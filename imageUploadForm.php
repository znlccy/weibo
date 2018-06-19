<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/15
 * Time: 13:32
 * Comment: 上传图片
 */
    //判断上传文件是否满足需求
    if (!$_FILES['Filedata']) {
        die('Image data not detected!');
    }

    if ($_FILES['Filedata']['error'] > 0 ) {
        switch ($_FILES['Filedata']['error']) {
            case 1:                     //上传文件大小超过服务器运行上传的最大值
                $error_log = 'The file is bigger than this PHP installation allows';
                break;
            case 2:                     //上传文件大小超过HTML表单中隐藏域MAX_FILE_SIZE选项的值
                $error_log = 'The file is bigger than this form allows';
                break;
            case 3:                     //文件只有部分被上传
                $error_log = 'Only part of the file was uploaded';
                break;
            case 4:                     //没有文件被上传
                $error_log = 'No file was upload';
                break;
            default:                    //默认情况
                break;
        }
        die('Upload Error:' . $error_log);
    } else {                            //上传成功
        $img_data = $_FILES['Filedata']['tmp_name'];        //获取临时文件名
        $size = getimagesize($img_data);                    //获取文件上传大小
        $file_type = $size['name'];                         //获取文件上传类型
        if (!in_array($file_type, array('image/jpg', 'image/jpeg', 'image/png', 'image/gif'))) {
            $error_log = 'only allow jpg,png,gif';
            die('Upload Error:' . $error_log);              //文件类型错误，输出错误信息
        }
        switch ($file_type) {
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                $extention = 'jpg';
                break;
            case 'image/png':
                $extention = 'png';
                break;
            case 'image/gif':
                $extention = 'gif';
                break;
        }
    }
    if (!is_file($img_data)) {
        die('Image upload error!');
    }
    //图片保存路径，默认保存在该代码所在的目录(可根据实际需求修改保存路径)
    $save_path = dirname(__FILE__).'public/images/upload/head_image';
    $uniqid = uniqid();
    $filename = $save_path . '/' . $uniqid . '.' . $extention;
    $result = move_uploaded_file($img_data, $filename);
    if (! $result || !is_file($filename)) {
        die('Image upload error!');
    }
    echo 'Image data save successed,file:' . $filename;

    require ('library/Db.class.php');                       //连接数据库
    session_start();                                         //开启Session
    $user_id = $_SESSION['user']['id'];                      //获取登录的用户id
    $db = new DB();                                          //数据库实例化
    $head = $uniqid . '.' . $extention;                      //组装路径
    $sql = "update zc_user set avatar = :head where id = :user_id";
    $res = $db->query($sql, array("user_id" => $user_id, "head" => $head));
    $_SESSION['user']['avatar'] = $head;                     //更改头像Session信息
    exit();
?>