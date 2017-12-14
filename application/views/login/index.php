<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $title; ?></title>
    <base href="<?php echo base_url(); ?>">
    <!--[if lt IE 9]>
    <script>alert("你的浏览器版本太低，为免影响操作，\n建议使用：IE9+、谷哥或火狐等浏览器。");</script>
    <![endif]-->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
<div class="header">
    <div class="container">
        <span class="logo"><img src="/images/logo.png" alt="" />游机科技管理后台</span>
    </div>
</div>
<div class="main">
    <div class="login-panel">
        <div class="container">
            <div class="login">
                <div class="login-tle">
                    <h3>用户登录</h3>
                </div>
                <form class="login-form" id="login_frm" method="post" action="">
                    <div class="form-group fn-mb-20">
                        <i class="i-ipt i-user"></i>
                        <input type="text" class="form-control input-lg name" value="" name="username" placeholder="请输入用户名" required>
                    </div>
                    <div class="form-group fn-mb-20">
                        <i class="i-ipt i-pwd"></i>
                        <input type="text" class="form-control input-lg pwd" value="" name="password" placeholder="请输入密码" required onfocus="this.type='password'" autocomplete="off">
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">登 录</button>
                </form>
            </div>
            <div class="login-shadow"></div>
            <div class="flip-logo" id="view_flip">
                <div class="flipper">
                    <span class="big-lg-front"></span>
                    <span class="big-lg-back"></span>
                </div>
            </div>
            <div class="big-lg-shadow"></div>
            <i class="circle c-default"></i><i class="circle c-purple"></i><i class="circle c-pink"></i>
            <i class="circle c-green"></i><i class="circle c-yellow"></i><i class="circle c-blue"></i><i class="circle c-other"></i>
        </div>
    </div>
</div>
<script src="/js/plugins/jquery.js"></script>
<script src="/js/plugins/layer/layer.js"></script>
<script>
    $(function () {
        //输入密码时，显示图像背面（表示不可见）
        var vFlip = $('#view_flip');
        $('input[type="password"]').on('focus blur', function (e) {
            (e.type == 'focus') ? vFlip.addClass('flip-focus') : vFlip.removeClass('flip-focus');
        });

        $('#login_frm').submit(function(){
            var user = $('.name').val();
            var pwd = $('.pwd').val();
            $.ajax({
              url: '/login/check_login',
              type: 'post',
              data: {'username':user,'password':pwd},
              dataType: 'json',
              success: function (data) {
                if(data.ack == true){
                    layer.msg('登录成功，正在跳转',{time:2000});
                    window.setTimeout(function(){
                        window.location.href='/personal/index';
                    },1500);
                    
                }else{
                    layer.msg(data.msg);
                }
              },
              error:function(){
                layer.msg('网络异常');
              }
            });return false;
            
        });
        
    });
</script>
</body>
