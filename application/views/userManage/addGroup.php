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
    <div class="bootstrap-table">
        <form id="add-group" class="form-horizontal" method="post">
            <div class="row">
                <table class="table table-bordered">
                    <tr>
                        <td colspan='2'>
                            <!-- <div class="form-group"> -->
                                <label for="groupName" class="col-sm-2 col-sm-offset-2 control-label">组名：</label>
                                <div class="col-sm-4">
                                  <input type="text" name="group_name" class="form-control" id="groupName" placeholder="填写组名" required>
                                </div>
                            <!-- </div> -->
                        </td>
                    </tr>
                    <?php foreach ($top_menu as $top): ?>
                    <tr>                        
                        <th width="10%" style="vertical-align: middle;text-align:center;">
                            <?php echo $top['title'];?>
                        </th>

                        <td>
                            <?php foreach ($menu as $sub): ?>
                                <?php if ($top['id'] == $sub['parent_id']): ?>
                                    <div class="check-box" style="min-height:50px;">
                                        <div class="checkbox" style="float:left;height:30px;margin-right:100px;">
                                            <label>
                                              <input class="all-check" type="checkbox"> <b><?php echo $sub['title'];?></b>
                                            </label>
                                        </div>
                                        <?php foreach ($rules as $rule): ?>
                                            <?php if($sub['id'] == $rule['m_id']): ?>
                                                <div class="checkbox" style="float:left;padding:10px 10px;">
                                                    <label >
                                                      <input name="rules[]" class="one-check" type="checkbox" value="<?php echo $rule['id'];?>"> <span><?php echo $rule['title'];?></span>
                                                    </label>
                                                </div>
                                            <?php endif;?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>              
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan='2'>
                            <button type="submit" class="btn btn-primary btn-lg col-sm-4 col-sm-offset-4">添加</button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
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
            //父级地址
            var parentURL = window.parent.location.href;

            checkAll();
            $('#add-group').submit(function(){
                var datas = $(this).serialize();
                $.ajax({
                    url: 'user/addGroup',
                    type: 'post',
                    data: datas,
                    dataType : 'json',
                    success: function(data){
                        if(data.ack){
                            layer.msg(data.msg,{time:1200},function(){
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
        });
    </script>
</body>
</html>
