<!-- 引入头部 -->
<?php include ("view/common/header.php"); ?>
<body>

<!-- 引入头部菜单 -->
<?php include ("view/common/head.php"); ?>

<!-- 主体部分开始 -->
<div class="main">
    <div class="left">
        <!-- 引入微博发送框 -->
        <?php include ("view/common/send-weibo.php"); ?>

        <!-- 广告开始 -->
        <div class="little_banner">
            <a href="https://mrbccd.taobao.com"></a>
            <img src="public/images/weibo_banner.png">
        </div>
        <!-- 广告结束 -->

        <h4 class="weibo_list_title">全部微博</h4>
        <?php
            if (!isset($lists)) {
        ?>
        <div class="empty">
            <p>还没有微博哦!</p>
        </div>
        <?php } else {
                //微博列表
                include_once ("view/common/weibo-list.php");
                //分页
                include_once ("view/common/page.php");
            } ?>
    </div>
    <!-- 个人信息 -->
    <?php include_once ("view/common/profile.php"); ?>
</div>
<!-- 底部信息 -->
<?php include_once ("view/common/footer.php"); ?>
</body>
</html>