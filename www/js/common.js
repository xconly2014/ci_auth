var dataCtrl = {
    //当前菜单
    currNav: function (ele,top_nav) {
        document.getElementById(ele).className = 'btn btn-primary';
        $('.sidebar>ul>li>a').each(function(i){
            if($(this).attr('href') == top_nav){
                // alert($(this).attr('href'));
                $(this).parent().addClass('active');
            }
        });
    },
    //table 全选/反选
    tableCheckAll: function () {
        /* 全选/反选 */

        $(document).on('click', '.check-all', function (event) {
            var $tbrIpt = $(this).parents('thead').next('tbody').find('input[type="checkbox"]');
            // 将所有行的选中状态设成全选框的选中状态
            $tbrIpt.prop('checked', $(this).prop('checked'));
            // 调整所有选中行的CSS样式
            if ($(this).prop('checked')) {
                $tbrIpt.attr('checked', 'checked').parents('tr').addClass('selected');
            } else {
                $tbrIpt.removeAttr('checked').parents('tr').removeClass('selected');
            }
            event.stopPropagation();
        });

        // 点击全选框所在单元格时也触发全选框的点击操作
        $(document).on('click', 'thead th', function () {
            $(this).find('input').click();
        });

        // 点击每一行的复选框时
        $(document).on('click', 'tbody input[type="checkbox"]', function (event) {
            // 调整选中行的CSS样式
            $(this).parents('tr').toggleClass('selected');

            // 此行复选框状态
            $(this).prop('checked') ? $(this).attr('checked', 'checked') : $(this).removeAttr('checked');


            // 如果已经被选中行的行数等于表格的数据行数，将全选框设为选中状态，否则设为未选中状态
            var $checkAll = $('table thead tr').find('input'), $tbr = $('table tbody tr');
            $checkAll.prop('checked', $tbr.find('input:checked').length == $tbr.length ? true : false);
            event.stopPropagation();
        });

        // 点击每一行时
        $(document).on('click', 'tbody tr', function () {
            var $itemChk = $(this).find('input[type="checkbox"]');
            $itemChk.click();
            $itemChk.prop('checked') ? $itemChk.attr('checked', 'checked') : $itemChk.removeAttr('checked');
        });
    }
};

//日期时间段插件参数
var isDateRange = $('body').find('.datepicker');
if(isDateRange.length > 0) {
    var dateRangeOption = {
        "locale": {
            "format": 'YYYY-MM-DD',
            "separator": " ～ ",
            "applyLabel": "确定",
            "cancelLabel": "取消",
            "fromLabel": "起始时间",
            "toLabel": "结束时间'",
            "customRangeLabel": "自定义",
            "weekLabel": "W",
            "daysOfWeek": ["日", "一", "二", "三", "四", "五", "六"],
            "monthNames": ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
            "firstDay": 1
        },
        "ranges": {
            '今日': [moment(), moment()],
            '昨日': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '近7日': [moment().subtract(6, 'days'), moment()],
            '近30日': [moment().subtract(29, 'days'), moment()],
            '本月': [moment().startOf('month'), moment().endOf('month')],
            '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            //, '全时期': [moment().startOf('year'), moment().endOf('year')]
        },
        //"opens": "left",
        "alwaysShowCalendars": true
    };
}

//权限页全选
function checkAll(){
    $(document).on('click', '.all-check', function (event){
        var $oneChk = $(this).parents('.check-box').find('.one-check');

        $oneChk.prop('checked',$(this).prop('checked'));
        event.stopPropagation();
    });
    
}

$(function () {
    var $a = $('a[data-control]'), $hoverDown = $('[data-tab="hoverdown"]');

    //侧边菜单展开动画
    $a.on('mouseenter mouseleave', function (event) {
        var self = $(this);
        if (event.type == 'mouseenter') {
            self.animate({width: 150});
        } else {
            self.animate({width: 66});
        }
    });

    //悬浮下拉
    $hoverDown.on('mouseenter mouseleave', function (event) {
        var self = $(this);
        (event.type == 'mouseenter') ? self.addClass('open') : self.removeClass('open');
    });

    //关闭|展开 查询面板
    $('#filter_hd').click(function () {
        var $tx = $(this).find('.filter-hd-i'), $filterBd = $('#filter_bd');
        if($filterBd.hasClass('hide')){
            $filterBd.removeClass('hide');
            $tx.html('<i class="glyphicons glyphicons-chevron-up"></i>');
        }else{
            $filterBd.addClass('hide');
            $tx.html('<i class="glyphicons glyphicons-chevron-down"></i>');
        }
    });

    $('.side-nav').click(function(){
        $(this).next('.nav').slideToggle("slow");
    });

    $('.app-menu').click(function(){
        var app_id = $(this).data('id');
        var app_name = $(this).find('a').text();
        $('.curr-name').text(app_name);
        var datas = {app_id:app_id,app_name:app_name}
        $.ajax({
            url: 'personal/appchose',
            type: 'post',
            data: datas,
            dataType: 'json',
            success: function(data){
                if(data.ack == true){
                    layer.msg(data.msg,{time:1000},function(){
                        window.location.reload(true);
                    });                    
                }else{
                    layer.msg(data.msg);
                }
            }
        });
    });

    //修改密码
    $('#change-pwd').click(function(){
        layer.open({
            type: 2,
            title: '修改登录密码',
            shade: 0.5,
            area:['600px', '400px'],
            content: 'personal/changepwd'
        });
    });

    //select控件
    var $select = $(".select");
    if($select.length > 0){
        var bl = false;
        $select.each(function () {
            bl = $(this).data('search');
            if(bl == true){
                $(this).select2({placeholder: '请选择', minimumResultsForSearch: Infinity});
            }else{
                $(this).select2({ placeholder: '请选择'});
            }
        });
    }

    //tooltip
    // $('[data-toggle="tooltip"]').tooltip({container: 'body', placement: 'top', trigger: 'hover'});

    //popover
    var ContentMethod = function(txt) {
        return txt;
    };

    $('[data-toggle="popover"]').each(function () {
        var element = $(this), id = element.attr('id'), txt = element.html();
        element.popover({
            trigger: 'manual',
            //placement: 'right', //top, bottom, left or right
            title: txt,
            html: 'true',
            content: ContentMethod(txt)
        }).on("mouseenter", function () {
            var _this = this;
            $(this).popover("show");
            $(this).siblings(".popover").on("mouseleave", function () {
                $(_this).popover('hide');
            });
        }).on("mouseleave", function () {
            var _this = this;
            setTimeout(function () {
                if (!$(".popover:hover").length) {
                    $(_this).popover("hide");
                }
            }, 100);
        });
    });

});

/*
 @支持所有列表修改调用
 @_self:当前修改的dom 对象
 @context:表单改动,列表进行刷新数据true
 @form_val_list:表单值(注意与列表获取的数组值形成映射关系，注意顺序)
 @id_form_list:表单id数组,需要排序，和列表映射['#nam','#ids']
 @_textlist:列表需要获取的文字数组
 @class_name:需要获取数据classname,需要table标签自定义这个类名　eg:<tr class="tr">mmmm</tr>
 @IsSelectArr:下拉选择框的游戏名，如<option>大主宰</option>
 @fn:不需要初始化的select
 */
function docomforms(_self, id_form_list, class_name, IsSelectArr, context, fn) {

    docomforms.self = _self;//保存点击修改时的this 指向
    docomforms.id = _self.data('id');//保存当前data id的值
    var _textlist = _self.parents('tr').find(class_name),//获取表格中需要修改的文字数组
        len = _textlist.length,//表单值个数
        isSelectArr = Object.prototype.toString.call(IsSelectArr) === '[object Array]',//若是数组，说明表单中有下拉框
        regexp = /usegame/g,//是否存在需要初始化select的表单
        fn = typeof fn == "function" && fn;//是否存在函数参数
    //表单改动列表刷新
    if (context) {
        console.log("error");
        for (var i = 0; i < len; i++) {
            //若是select，获取则用text()
            if ($(id_form_list[i])[0].tagName.toLowerCase() === 'select') {

                _textlist.eq(i).text($(id_form_list[i]).find("option:selected").text());
            } else {
                _textlist.eq(i).text($(id_form_list[i]).val());
            }
            //$(id_form_list[i]).val('');
        }
    } else {
        //点击修改按钮表单不改动，只显示。此种情况分为存在select和不存在select
        if (isSelectArr) {//若存在select表单,则初始化每个表单，反之全当input处理
            for (var i = 0; i < len; i++) {
                var _text = $.trim(_textlist.eq(i).text()),
                    str = $(id_form_list[i])[0].className ? $(id_form_list[i])[0].className.toLowerCase() : "",
                    isSelect = $(id_form_list[i])[0].tagName.toLowerCase() === 'select';
                //如果是select并且有usegame类名执行初始化
                isSelect && regexp.test(str) ? SelectInit(IsSelectArr, $(id_form_list[i]), _text) : isSelect && fn ? fn(_text) : $(id_form_list[i]).val(_text);

            }
        } else {//若不存在isSelectArr
            for (var i = 0; i < len; i++) {
                var _text = $.trim(_textlist.eq(i).text());
                $(id_form_list[i]).val(_text);
            }
        }


    }
}
/*
 @DataArr:传入的option 数组
 @dom:selct框对应的id
 @option_initText:option_initText="<option value='' selected disabled>请选择</option>"
 @_text select 当前的value
 */
function SelectInit(DataArr, dom, _text) {
    /*新增规则游戏select框填充*/
    var HtmlStr = "",
        option_initText = "<option value='' selected disabled>请选择</option>";
    $.each(DataArr, function (i, val) {
        HtmlStr += "<option value='" + val.id + "'>" + val.name + "</option>";
        if (i == DataArr.length - 1) {
            dom.html(HtmlStr);
            dom.prepend(option_initText);
            dom.selectpicker({
                style: 'btn-info'
            });
        }
    });
    $.each(DataArr, function (i, val) {
        /*是否存在_text*/

        if ($.trim(val.name) == $.trim(_text)) {
            dom.selectpicker('val', i);//选中
        }

    });

}
/*
 popover组件在ajax插入页码数据完成时调用   
*/
function popover_tip(){
     var ContentMethod = function(txt) {
        return txt;
    };
    $('[data-toggle="popover"]').each(function () {
        var element = $(this), id = element.attr('id'), txt = element.html();
        element.popover({
            trigger: 'manual',
            placement: 'top', //top, bottom, left or right
            title: txt,
            html: 'true',
            content: ContentMethod(txt)
        }).on("mouseenter", function () {
            var _this = this;
            $(this).popover("show");
            $(this).siblings(".popover").on("mouseleave", function () {
                $(_this).popover('hide');
            });
        }).on("mouseleave", function () {
            var _this = this;
            setTimeout(function () {
                if (!$(".popover:hover").length) {
                    $(_this).popover("hide");
                }
            }, 100);
        });
    });
}