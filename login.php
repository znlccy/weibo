<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>登录</title>

    <!-- 设置浏览器左上角图标 -->
    <link rel="icon" type="image/x-icon" href="public/ico/weibo.ico"/>

    <!-- 引入css样式文件 -->
    <link rel="stylesheet" type="text/css" href="public/css/semantic.css" />
    <link rel="stylesheet" type="text/css" href="public/css/login.css" />
    <link rel="stylesheet" type="text/css" href="public/css/layer.css" />
    <!-- 引入外部js -->
    <script type="text/javascript" src="public/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="public/static/layer/layer.js"></script>
</head>
<body>
    <!-- 头部区域开始 -->
    <div class="header" title="头部">
        <img src="public/images/login_logo.png" />
    </div>
    <!-- 头部区域结束 -->

    <!-- 主体区域开始 -->
    <div class="main">

        <!-- 左边区域 -->
        <div class="left">
            <div class="login-bg">
                <img src="public/images/login_banner.png">
            </div>
        </div>

        <!-- 内容区域 -->
        <div class="content">
            <!-- 用户输入区域开始 -->
            <div class="ui big form">
                <div class="ui stacked segment blue">

                    <div class="field">
                        <div class="ui icon input">
                            <i class="user icon"></i>
                            <input type="text" name="username" placeholder="用户名">
                        </div>
                    </div>

                    <div class="field">
                        <div class="ui icon input">
                           <i class="lock icon"></i>
                            <input type="password" name="password" placeholder="密码">
                        </div>
                    </div>

                    <button id="login" class="ui fluid large teal submit button">登录</button>

                </div>

                <div class="ui message">
                    新用户?<a href="register.php">注册</a>
                </div>
            </div>
            <!-- 用户输入区域 -->

            <!-- 推荐用户开始 -->
            <div class="recommend">
                <div class="ui horizontal divider">
                    <h4 class="ui teal">推荐用户</h4>
                </div>
                <div class="ui tiny images">
                    <img class="ui medium circular image" src="public/images/steve_01.png">
                    <img class="ui medium circular image" src="public/images/steve_02.png">
                    <img class="ui medium circular image" src="public/images/steve_03.png">
                    <img class="ui medium circular image" src="public/images/steve_04.png">
                    <img class="ui medium circular image" src="public/images/steve_05.png">
                    <img class="ui medium circular image" src="public/images/steve_06.png">
                    <img class="ui medium circular image" src="public/images/steve_07.png">
                    <img class="ui medium circular image" src="public/images/steve_08.png">
                    <img class="ui medium circular image" src="public/images/steve_09.png">
                </div>
            </div>
            <!-- 推荐用户结束 -->
        </div>
    </div>

    <div class="clear"></div>

    <!-- 网站底部开始 -->
    <div class="footer">
        Copyright@2018上海市玲叶科技有限公司
    </div>

    <script>
        $('#login').click(function () {
            var username = $("input[name='username']").val();    //获取用户名
            var password = $("input[name='password']").val();    //获取密码

            //js验证用户名和密码
            if (username == '') {
                layer.msg('请填写用户名');                    //layer弹层插件提示信息
                return false
            }

            if (password == '') {
                layer.msg('请填写密码');                     //layer弹层插件提示信息
                return false;
            }

            //JS验证
            $.post("ajaxCheckLogin.php", {username: username, password: password}, function (data) {
                if (data == -1) {
                    layer.msg('用户名或密码错误');
                    return false;
                }
                if (data == 1) {
                    window.location.href = "index.php";
                }
            });
            return false;
        });
    </script>

    <!-- 主体区域结束 -->
</body>
</html>