<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $title; ?></title>
    <base href="<?php echo base_url(); ?>">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-table.min.css">
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
        <div class="panel-heading" id="filter_hd">
            <h4 class="panel-title">
                <i class="glyphicons glyphicons-search fn-mr-5"></i>
                操作日志查询<span class="filter-hd-i fn-ml-10"><i class="glyphicons glyphicons-chevron-down"></i></span>
            </h4>
        </div>
        <div class="panel-body" id="filter_bd">
            <form id="filer_form" class="form-
             set-filter-form" role="form" action="">
                <div class="row">
                    <label class="col-sm-2 control-label" style="padding-top:8px;text-align:right;">操作者帐号</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="uname">
                    </div>
                    <label class="col-sm-2 control-label" style="padding-top:8px;text-align:right;">操作者对象</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="target">
                    </div>                
                    <div class="col-sm-3">
                        <button class="btn btn-primary">查询</button>
                    </div>
                </div>
            </form>
           
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">操作日志列表</h4>
        </div>
        <div class="panel-body">
            <div class="bootstrap-table">
                <div class="fixed-table-container">
                    <!--{ fixed-table-body -->
                    <div class="fixed-table-body">
                        <table id="table" class="table-striped table table-hover">
                            <thead>
                                <tr>
                                    <th><div class="th-inner">时间</div></th>
                                    <th><div class="th-inner">操作者帐号</div></th>
                                    <th><div class="th-inner">模块</div></th>
                                    <th><div class="th-inner">操作</div></th>
                                    <th><div class="th-inner">对象帐号(或UID)</div></th>
                                </tr>
                            </thead>
                            <tbody id="td_list">
                                <?php foreach($list as $v): ?>
                                    <tr>
                                        <td>
                                            <div class="td-inner-tx"><?php echo $v['create_time'];?></div>
                                        </td>
                                        <td>
                                            <div class="td-inner-tx"><?php echo $v['uname'];?></div>
                                        </td>
                                        <td>
                                            <div class="td-inner-tx"><?php echo $v['module'];?></div>
                                        </td>
                                        <td>
                                            <div class="td-inner-tx"><?php echo $v['action'];?></div>
                                        </td>
                                        <td>
                                            <div class="td-inner-tx"><?php echo $v['target'];?></div>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <!--/ fixed-table-body end }-->
                </div>
                <!--{ fixed-table-pagination -->
                <div class="fixed-table-pagination clearfix">
                    <div class="pull-right pagination" id="DataTables_paginate">
                        <?php echo $page;?>
                    </div>
                </div>
                <!--/ fixed-table-pagination }-->
            </div>
            <!--/ bootstrap-table end -->
        </div>
        <!--/ panel-body end -->
    </div>
    <!--/ panel end -->
</div>

<script src="/js/plugins/jquery.js"></script>
<script src="/js/plugins/bootstrap.min.js"></script>
<script src="/js/plugins/layer/layer.js"></script>
<script src="/js/common.js"></script>
<script>
    $(function(){
        $('.show-btn').click(function(){
            layer.open({
                type: 2,
              title: '反馈详情',
              shadeClose: true,
              shade: 0.8,
              area: ['800px', '650px'],
              content: ''
            });
        });
    })
</script>
</body>
