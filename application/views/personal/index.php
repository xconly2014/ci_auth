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
    <link rel="stylesheet" href="css/iconfont.css">

</head>

<body>
<!-- topNav -->
<?php $this->load->view('include/topNav'); ?>
<!-- sideBar -->
<?php $this->load->view('include/sideBar'); ?>

<div class="container-fluid data-main">
    <div class="panel panel-default">
        <div class="panel-heading" style="height:800px;">
            <h4 class="panel-title">管理后台首页</h4>
        </div>
    </div>
    <!--/ panel end -->
</div>

<script src="/js/plugins/jquery.js"></script>
<script src="/js/plugins/bootstrap.min.js"></script>
<script src="/js/plugins/layer/layer.js"></script>
<script src="/js/common.js"></script>
</body>
