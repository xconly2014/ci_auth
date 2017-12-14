<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $title; ?></title>
    <base href="<?php echo base_url(); ?>">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/layout.css">
</head>

<body class="iframe-body">
<!--{ 新增用户 -->
<div class="row">
    <div class="col-sm-12">
        <form class="form-horizontal" id="change-pwd" role="form">
            <div class="form-group">
                <label class="col-sm-2 control-label">旧密码</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="old-pwd" name="old_pwd" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">新密码</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="new-pwd" name="new_pwd" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">重复密码</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="re-pwd" name="re_pwd" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary" id="ok_btn">
                        <i class="glyphicons glyphicons-ok fn-mr-5"></i>确定
                    </button>
                    <a type="button" class="btn btn-default" id="cancel_btn">取消</a>
                </div>
            </div>
        </form>
    </div>
</div>
<!--/ 新增用户 }-->

<script src="js/plugins/jquery.js"></script>
<script src="js/plugins/layer/layer.js"></script>
<script>
    $(function () {

        //得到当前iframe层的索引
        var index = parent.layer.getFrameIndex(window.name);

        //确定
        $('#change-pwd').submit(function () {

            var new_pwd = $('#new-pwd').val();
            var re_pwd = $('#re-pwd').val();
            if(new_pwd != re_pwd){
                layer.msg('两次输入密码不一致');
                return false;
            }
            
            //父级地址
            var parentURL = window.parent.location.href;
            
            //请配置ajax
            var datas = $('#change-pwd').serialize();
            $.ajax({
                url: 'personal/changepwd',
                type: 'post',
                data: datas,
                dataType: 'json',
                success: function (data) {
                    if (data.ack == true) {
                        layer.msg(data.msg, {time: 1200}, function () {
                            //成功后重新刷新父级页面
                            window.parent.location.reload(parentURL);
                        });
                    }else{
                        layer.msg(data.msg, {time: 1200});
                    }
                }
            });

            return false;
        });

        //取消
        $('#cancel_btn').click(function () {
            parent.layer.close(index);
        });
    });
    
</script>
</body>
</html>
