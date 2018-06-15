<!-- 引入头部 -->
<?php include ("view/common/header.php"); ?>

<!-- 引入美图秀秀 -->
<script src="http://open.web.meitu.com/sources/xiuxiu.js" type="text/javascript"></script>
<script type="text/javascript" src="public/js/meitu.js"></script>

<!-- 引入导航 -->
<?php include ("view/common/head.php"); ?>
<body>
    <div class="my_head width_1000">
        <div class="my_head_img">
            <img value="<?php echo $user['avatar']?>" src="<?php echo get_cover_path($user['avatar']) ?>">
        </div>
        <h4>
            <?php echo $user['username'] ?>
        </h4>
        <div class="my_head_message">
            <ul class="fl">
                <li>注册于: <?php echo date('Y-m-d', $user['addtime']) ?></li>
            </ul>
            <div class="my_info_list fr">
                <div class="fr">
                    <ul>
                        <li><span><?php echo $user['follows_num'] ?></span></li>
                        <li>关注</li>
                    </ul>
                    <ol></ol>
                    <ul>
                        <li><span><?php echo $user['fans_num'] ?></span></li>
                        <li>粉丝</li>
                    </ul>
                    <ol></ol>
                    <ul>
                        <li><span><?php echo $user['posts_num'] ?></span></li>
                        <li>微博</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="main">
        <div class="left setting-head">
            <!-- Tab选项卡 -->
            <div style="font-size: 15px;" class="ui top attached tabular menu new_menu">
                <a class="item active" data-tab="first">头像设置</a>
                <a class="item" data-tab="second">资料设置</a>
                <a class="item" data-tab="third">更改密码</a>
            </div>

            <!-- 头像设置选项 -->
            <div class="ui bottom attached tab segment segment_new active" data-tab="first">
                <div style="height: 400px">
                    <div id="altContent"></div>
                </div>
            </div>

            <!-- 资料设置选项 -->
            <div class="ui bottom attached tab segment segment_new" data-tab="second">
                <form class="ui form" method="post" action="saveSetting.php">
                    <div class="field">
                        <label style="font-size: 14px">用户名</label>
                        <input style="font-size: 13px" type="text" value="<?php echo $user['username'] ?>" readonly>
                    </div>
                    <div class="field">
                        <label style="font-size: 14px">注册日期</label>
                        <input style="font-size: 13px" type="text" value="<?php echo date('Y-m-d', $user['addtime']) ?>" readonly>
                    </div>
                    <div class="field">
                        <label style="font-size: 14px">性别</label>
                        <select name="sex" style="font-size: 13px"  class="ui fluid dropdown">
                            <option value="0" <?php if ($user['sex']==0){ echo 'selected';} ?>>
                                保密
                            </option>
                            <option value="1" <?php if ($user['sex']==1){ echo 'selected';} ?>>
                                男
                            </option>
                            <option value="2" <?php if ($user['sex']==2){ echo 'selected';} ?>>
                                女
                            </option>
                        </select>
                    </div>
                    <div class="field">
                        <label style="font-size: 14px">QQ</label>
                        <input style="font-size: 13px" type="text" name="qq" value="<?php echo $user['qq'] ?>">
                    </div>
                    <div class="field">
                        <label style="font-size: 14px">邮箱</label>
                        <input style="font-size: 13px" type="text" name="email" value="<?php echo $user['email'] ?>">
                    </div>
                    <button class="ui teal button" style="font-size: 15px" type="submit">提交</button>
                </form>
            </div>
            <!-- 更改密码选项 -->
            <div class="ui bottom attached tab segment segment_new" data-tab="third">
                <form action="changePassword" method="post">
                    <div class="ui form">
                        <div class="required field">
                            <label style="font-size: 14px">原始密码</label>
                            <input style="font-size: 13px" type="password" name="old_password" id="old_password" />
                        </div>
                        <div class="required field">
                            <label style="font-size: 14px">新密码</label>
                            <input style="font-size: 13px" type="password" name="new_password" id="new_password">
                        </div>
                        <div class="required field">
                            <label style="font-size: 14px">确认新密码</label>
                            <input style="font-size: 13px" type="password" name="new_password2" id="new_password2">
                        </div>
                        <div id="save-password" style="font-size: 15px" class="ui submit teal button">确认</div>
                    </div>
                </form>
            </div>
        </div>
        <?php include_once ("view/common/profile.php"); ?>
    </div>
    <!-- 底部信息 -->
    <?php include_once ("view/common/footer.php"); ?>
</body>
</html>