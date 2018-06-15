<!-- 导航 -->
<div class="nav">
    <div class="width_1200">
        <ul>
            <li><a href="index.php" style="font-size: 15px;">微博大厅</a></li>
            <li style="padding-right: 20px">
                <form action="search.php" method="post">
                    <input type="text" name="keyword" placeholder="三千世界来搜一搜吧..." />
                    <button type="button" class="search"></button>
                </form>
            </li>
            <li style="padding-left: 10px"><a href="myCollect.php" style="font-size: 15px;">我的收藏</a></li>
            <li><a href="myPraise.php" style="font-size: 15px;">我的赞</a></li>
        </ul>
        <ol>
            <li>
                <a href="setting.php" style="font-size: 15px; ">
                    <?php echo $_SESSION['user']['username']; ?>
                </a>
            </li>
            <li class="li_message">
                &nbsp;
                <dl class="menu">
                    <dd><a href="atMe.php">@我的</a></dd>
                    <dd><a href="message.php">我的消息</a></dd>
                </dl>
            </li>
            <li class="li_set">
                &nbsp;
                <dl class="menu">
                    <dd><a href="setting.php">个人中心</a></dd>
                    <dd><a href="logout.php">退出</a></dd>
                </dl>
            </li>
        </ol>
    </div>
</div>