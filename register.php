<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>注册</title>

    <!-- 设置浏览器左上角的图标 -->
    <link rel="icon" type="image/x-icon" href="public/ico/weibo.ico" />

    <!-- 引入外部css层叠样式表 -->
    <link rel="stylesheet" type="text/css" href="public/css/semantic.css" />
    <link rel="stylesheet" type="text/css" href="public/css/register.css" />
    <link rel="stylesheet" type="text/css" href="public/css/layer.css" />

    <!-- 引入外部js文件 -->
    <script type="text/javascript" src="public/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="public/static/layer/layer.js"></script>
</head>
<body>

    <!-- 头部区域开始 -->
    <div class="header" title="头部">
        <img src="public/images/login_logo.png" />
    </div>
    <!-- 头部区域结束 -->

    <!-- 主体部分开始 -->
    <div class="main">
        <div class="left">
            <div class="login-bg">
                <img src="public/images/login_banner.png" />
            </div>
        </div>

        <!-- 内容部分开始 -->
        <div class="content">
            <!-- 用户输入区域开始 -->
            <div class="ui big form">
                <div class="ui stacked segment blue">
                    <div class="field">
                        <div class="ui icon input">
                            <i class="user icon"></i>
                            <input type="text" name="username" placeholder="用户名" />
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password" placeholder="密码" />
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="repassword" placeholder="确认密码" />
                        </div>
                    </div>
                    <button id="register" class="ui fluid large teal submit button">注册</button>
                </div>

                <div class="ui message">
                    已有账号,直接<a href="login.php">登录</a>
                </div>

            </div>
            <!-- 用户输入区域结束 -->

            <!-- 推荐用户区开始 -->
            <div class="recommend">
                <div class="ui horizontal divider">
                    <h4 class="ui teal">推荐用户</h4>
                </div>
                <div class="ui tiny images">
                    <img src="public/images/steve_01.png" class="ui medium circular image">
                    <img src="public/images/steve_02.png" class="ui medium circular image">
                    <img src="public/images/steve_03.png" class="ui medium circular image">
                    <img src="public/images/steve_04.png" class="ui medium circular image">
                    <img src="public/images/steve_05.png" class="ui medium circular image">
                    <img src="public/images/steve_06.png" class="ui medium circular image">
                    <img src="public/images/steve_07.png" class="ui medium circular image">
                    <img src="public/images/steve_08.png" class="ui medium circular image">
                    <img src="public/images/steve_09.png" class="ui medium circular image">
                </div>
            </div>
            <!-- 推荐用户区结束 -->
        </div>
        <!-- 内容部分结束 -->
    </div>
    <!-- 主体部分结束 -->

    <div class="clear"></div>

    <!-- 网页底部开始 -->
    <div class="footer">
        Copyright@2018上海市玲叶科技有限公司
    </div>
    <!-- 网页底部结束 -->

    <!-- JS脚本部分开始 -->
    <script>
        $('#register').click(function () {
            var username = $("input[name='username']").val();           //获取用户名
            var password = $("input[name='password']").val();           //获取密码
            var repassword = $("input[name='repassword']").val();       //获取确认密码

            //JS验证用户名和密码
            if (username == '') {
                layer.msg('请填写用户名');
                return false;
            }
            if (password == '') {
                layer.msg('请填写密码');
                return false;
            } else if (password.length >= 7) {
                layer.msg('密码长度超过6位');
                return false;
            }
            if (repassword == '') {
                layer.msg('请填写确认密码');
                return false;
            }
            if (password !== repassword) {
                layer.msg('两次输入密码不一致');
                return false;
            }

            //JS验证
            $.post("ajaxRegister.php",{username: username, password: password}, function (data) {
                if (data == -1) {
                    layer.msg('用户名已存在');
                    return false;
                }
                if (data == 1) {
                    layer.msg('注册成功',{time:1000},function () {
                        window.location.href = 'login.php';
                    });
                } else {
                    layer.msg('注册失败');
                    return false;
                }
            });
        });
    </script>
    <!-- JS脚本部分结束 -->
</body>
</html>