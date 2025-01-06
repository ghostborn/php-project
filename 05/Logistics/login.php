<?php
include_once('Library/function.php');

//判断是否登录
if (checkLogin()) {
	msg(2, '您已登录', 'index.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>明日物流配送信息网</title>
    <link href="Public/css/login.css" rel="stylesheet"/>
    <script src="Public/js/jquery.min.js"></script>
    <script src="Public/js/bootstrap.min.js"></script>
    <script src="Public/js/layer/layer.js"></script>
</head>
<body>
<div class="header">
    <div class="logo f1">
        <img height="40px" src="Public/images/logo.png">
    </div>
</div>

<div class="content">
    <div class="center">
        <div class="center-login">
            <div class="login-banner">
                <a href="#"><img src="Public/images/login_banner.png" alt=""></a>
            </div>
            <div class="user-login">
                <div class="user-box">
                    <div class="user-title">
                        <p style="text-align: center">后台登录</p>
                    </div>

                    <form class="login-table" name="login" id="login-form" method="post">
                        <div class="login-left form">
                            <label class="username">用户名</label>
                            <input type="text" class="yhmiput" name="admin_user" placeholder="用户名" id="username">
                        </div>
                        <div class="login-right">
                            <label class="passwd">密码</label>
                            <input type="password" class="yhmiput" name="admin_pass" placeholder="密码"
                                   id="password">
                        </div>
                        <div class="login-btn">
                            <button id="login">登录</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <p>Copyright@2017吉林省明日科技有限公司</p>
</div>

</body>

<script>
    $('#login').click(function () {
        const username = $('#username').val();
        const password = $('#password').val();
        if (username === '' || username.length <= 0) {
            layer.tips('用户名不能为空', '#username', {time: 2000, tips: 2});
            $('#username').focus();
            return false;
        }
        if (password === '' || password.length <= 0) {
            layer.tips('用户名不能为空', '#password', {time: 2000, tips: 2});
            $('#password').focus();
            return false;
        }
        $.post('check_login.php', {admin_user: username, admin_pass: password}, function (res) {
            console.log(res, 'aaa')
            if (res) {
                console.log(res, 'res');
                layer.msg('登录成功');
                window.location.href = "index.php"
            } else {
                layer.msg('用户名和密码不匹配');
            }
        })

        return false

    })
</script>


</html>
