$(function () {
    // dataCtrl.currNav('page_nav_3');

    // 查询|分页
    $('div#DataTables_paginate a').click(function(){
        var $filterFrm = $("#form");
        var tmpHref = $(this).attr('href');
        tmpHref = tmpHref.replace(/\/selCon\//,"");
        $filterFrm.attr("action", tmpHref);
        $filterFrm.submit();
        return false;
    });

    /*++++++++++++++++++++ 新增用户 ++++++++++++++++++++*/
    $(document).on('click', '.add-btn', function () {
        layer.open({
            type: 2,
            title: '新增用户',
            shade: 0.5,
            move: false,
            area: ['600px', '400px'],
            content: 'user/addUser'
        });
    });

    /*++++++++++++++++++++  编辑用户 ++++++++++++++++++++*/
    $(document).on('click', '.edit-btn', function () {
        var id = $(this).data('id');
        layer.open({
            type: 2,
            title: '编辑用户',
            shade: 0.5,
            move: false,
            area: ['600px', '400px'],
            content: 'user/editUser?id=' + id
        });
    });

    /*++++++++++++++++++++  删除用户 ++++++++++++++++++++*/
    $(document).on('click', '.del-btn', function () {
        var _this = $(this);
        var uid = _this.data('id');
        var index = layer.confirm('确定删除该用户吗？',{
            title: '三叉戟提示',
            closeBtn: false
        },function(){
            $.ajax({
                url: 'user/delUser',
                type: 'post',
                data :{uid:uid},
                dataType: 'json',
                success: function(data){
                    if(data.ack){
                        layer.msg('删除成功',{time:1500},function(){
                            _this.parents('tr').remove();
                        });                        
                    }else{
                        layer.msg('删除失败',{time:1500},function(){
                            layer.close(index);
                        }); 
                    }
                },
                error: function(){
                    layer.msg('删除失败',{time:1500},function(){
                        layer.close(index);
                    });                    
                }
            });
        });
        
    });

    /*++++++++++++++++++++ 新增用户组 ++++++++++++++++++++*/
    $(document).on('click', '.add-group', function () {
        layer.open({
            type: 2,
            title: '新增用户组',
            shade: 0.5,
            move: false,
            area: ['80%', '80%'],
            content: 'user/addGroup'
        });
    });

    /*++++++++++++++++++++ 编辑用户组 ++++++++++++++++++++*/
    $(document).on('click', '.edit-group', function () {
        var gid = $(this).data('id');
        layer.open({
            type: 2,
            title: '编辑用户组',
            shade: 0.5,
            move: false,
            area: ['80%', '80%'],
            content: 'user/editGroup?gid=' + gid
        });
    });

});