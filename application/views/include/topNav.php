<nav class="navbar navbar-fixed-top head-nav">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="/" class="navbar-brand">游机科技管理后台</a>
        </div>
        <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="javascript:void(0);"><i class="i-global i-product"></i>设置</a>
                </li>
                <li class="dropdown" data-tab="hoverdown">
                    <a href="javascript:void(0);" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION['user']['username'];?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li id="change-pwd"><a href="javascript:void(0);"><i class="glyphicons glyphicons-user-asterisk fn-mr-10"></i>修改密码</a></li>
                        <li><a href="<?php echo site_url('login/logout');?>"><i class="glyphicons glyphicons-power fn-mr-10"></i>退出登录</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>