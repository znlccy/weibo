$(function () {
    //点击@按钮，切换显示和隐藏
    $('.at-friend').click(function () {
        $('.interest-link').toggle();
    });

    //展开获取微博回复信息，关闭移除回复信息
    $(".weibo_list_bottom .weibo_list_bottom_message").click(function () {
        var total = $(this).children('span').html();
        var comment_list = $(this).parent().siblings(".weibo_comment").children(".comment_list");
        if (comment_list.is(":hidden")) {

        }
    });

    //检测数字
    function checknum(v, word) {
        var len = 140 - v.length();
        $('#sayword_' + word).text(len);
        if (len < 0) {
            $('#sayword_' + word).css({
                "color": "red"
            });
        }
    }

    //修改密码
    $('#save-password').click(function () {

        var old_password = $('#old_password').val();            //获得旧密码
        var new_password = $('#new_password').val();            //获得新密码
        var new_password2 = $('#new_password2').val();          //获取新确认密码

        //JS验证
        if (old_password == '') {
            layer.msg('原始密码不能为空');
            return false;
        }

        if (new_password == '') {
            layer.msg('新密码填写为空');
            return false;
        }

        if (new_password2 == '') {
            layer.msg('确认新密码填写为空');
            return false;
        }

        if (old_password === new_password) {
            layer.msg('新密码与原始密码不能相同');
            return false;
        }

        if (new_password !== new_password2) {
            layer.msg('新密码和确认密码不一致');
            return false;
        }

        $.post("changePassword.php", {old_password: old_password, new_password: new_password}, function (data) {
            if (data == -1) {
                layer.msg('原始密码错误');
                return false;
            }
            if (data == 0) {
                layer.msg('更改密码失败');
                return false;
            }
            if (data == 1) {
                layer.msg('更改密码成功');
                window.location.reload();
                /*window.location.href = 'login.php';*/
            }
        });
        return false;
    });
});