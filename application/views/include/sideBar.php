<div class="sidebar">
    <h4 style="padding-left:5px;cursor:pointer;" class="iconfont icon-index side-nav">
        <a class="" href="<?php echo site_url('personal/index');?>">首页</a>
    </h4>
    
    <?php $menu_structure = get_menu();?>
    <?php foreach($menu_structure as $menu): ?>
      <h4 style="padding-left:5px;cursor:pointer;" class="iconfont <?php echo $menu['img']?> side-nav"><?php echo $menu['title'];?></h4>
      <ul class="nav nav-pills nav-stacked" style="padding-left:5px;">
        <?php foreach($menu['sub'] as $sub): ?>
          <li role="presentation" class="<?php if(strtolower($this->uri->segment(1).'/'.$this->uri->segment(2)) == strtolower($sub['name'])) echo 'active'?>"><a href="<?php echo $sub['name'];?>"><?php echo $sub['title'];?></a></li>
        <?php endforeach; ?>
      </ul>
    <?php endforeach;?>


    <!-- <h4 class="iconfont icon-user side-nav">用户管理</h4>
    <ul class="nav nav-pills nav-stacked">
      <li role="presentation" class=""><a href="#">用户列表</a></li>
      <li role="presentation"><a href="#">角色管理</a></li>
      <li role="presentation"><a href="#">权限管理</a></li>
    </ul>
    <h4 class="iconfont icon-user side-nav">用户管理</h4>
    <ul class="nav nav-pills nav-stacked">
      <li role="presentation" class=""><a href="#">用户列表</a></li>
      <li role="presentation"><a href="#">角色管理</a></li>
      <li role="presentation"><a href="#">权限管理</a></li>
      <li role="presentation" class="<?php if($this->uri->segment(1).'/'.$this->uri->segment(2) == 'user/index') echo 'active'?>"><a href="<?php echo site_url('user/index');?>">用户列表</a></li>
      <li role="presentation" class="<?php if($this->uri->segment(1).'/'.$this->uri->segment(2) == 'user/grouplist') echo 'active'?>"><a href="<?php echo site_url('user/grouplist');?>">权限管理</a></li>
    </ul> -->
</div>