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
});