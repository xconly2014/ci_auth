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
    <link rel="stylesheet" href="css/select.css">
</head>

<body class="iframe-body">
<div class="row">
    <div class="col-sm-12">
        <form class="form-horizontal" id="edit_form" role="form">
            <div class="form-group">
                <label class="col-sm-3 control-label">用户名</label>
                <div class="col-sm-9">
                    <label class="control-label"><?php echo $username;?></label>
                    <input type="hidden" name="uid" value="<?php echo $id;?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">类型</label>
                <div class="col-sm-9">
                    <select class="select" id="group" name="group_id" data-search="true" style="width:100%;">
                        <?php foreach ($group as $v): ?>
                            <option value="<?php echo $v['id'];?>"><?php echo $v['title'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <button type="button" class="btn btn-primary" id="ok_btn" data-id="<?php echo $id;?>">
                        <i class="glyphicons glyphicons-ok fn-mr-5"></i>确定
                    </button>
                    <button type="button" class="btn btn-default" id="cancel_btn">取消</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="/js/plugins/jquery.js"></script>
<script src="/js/plugins/bootstrap.min.js"></script>
<script src="/js/plugins/select2.min.js"></script>
<script src="/js/plugins/layer/layer.js"></script>
<script src="/js/common.js"></script>
<script>
    $(function () {
        //得到当前iframe层的索引
        var index = parent.layer.getFrameIndex(window.name);

        //确定
        $('#ok_btn').click(function () {
            //父级地址
            var parentURL = window.parent.location.href;

            var datas = $('#edit_form').serialize();
            //请在这里配置ajax
            $.ajax({
                url: 'user/editUser',
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

        });

        //取消
        $('#cancel_btn').click(function () {
            parent.layer.close(index);
        });
    });
</script>
</body>
</html>
