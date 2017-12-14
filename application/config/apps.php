<?php
//app列表配置
$config['app_info'] = array(
	'1' => '来约棋牌',
    '2' => '来约斗牛',
);

$config['module'] = array(
    'indexs' => '首页',
    'user' => '用户管理',
    'account' => '帐号管理',
    'operation' => '运营管理',
    'roomcard' => '房卡管理',
    'club' => '俱乐部'
);
//系统消息类型
$config['msg_type'] = array(
    '1' => '系统公告消息',
    '2' => '首页滚动消息',
    '4' => '房卡充值引导'
);

//反馈信息标志
$config['feedback_resp_flag'] = array(
    '1' => '未处理',
    '2' => '已处理'
);
//反馈信息来源标志
$config['feedback_from'] = array(
    '1' => '公众号',
    '2' => '游戏app'
);

//流水变更类型
$config['update_type'] = array(
    '1' => '充值',
    '2' => '转出',
    '3' => '转入',
    '4' => '转出回退',
    '5' => '转入回退',
    '6' => '奖励',
    '7' => '派送',
    '8' => '消费',
    '9' => '苹果内购',
    '10' => '申请代理',
    '11' => '申请代理回退',
    '12' => '活动派卡',
    '13' => '签到派卡',
    '14' => '代开房',
    '15' => '代开房解散'
);

//ext 房卡流水扩展内容字段参数
$config['wallet_ext_doc'] = array(
    'gameid' => '游戏Id',
    'roomid' => '房间Id',
    'buy_amount' => '购买的数量',
    'free_amount' => '赠送的数量',
    'award_mahjong' => '奖励麻将房卡',
    'award_fightlandlord' => '奖励斗地主房卡',
    'buy_mahjong' => '购买麻将套餐',
    'buy_fightlandlord' => '购买斗地主套餐',
    'operation_user' => '操作账号',
    'content' => '备注内容',
    'rmb' => '人民币(分)',
    'activity_id' => '活动id',
    'name' => '名称',
    'game_type' => '游戏类型',
    'coin_type' => '卡类型',
    'wechat_orderid' => '订单号',
    'touid' => 'to玩家uid',
    'fromuid' => 'from玩家uid',
    'clubid' => '俱乐部id',
);

//游戏类型
$config['game_type'] = array(
    '1' => '麻将',
    '2' => '斗地主',
    '3' => '三公',
    '4' => '斗牛'
);

$config['app_game_type'] =array(
    '1' => array(
        '1' => '麻将',
        '2' => '斗地主'
    ),
    '2' => array(
        '4' => '斗牛'
    )
);

//活动派卡领取模式
$config['get_model'] = array(
    '1' => '首次登录',
    '2' => '每日登录'
);

//活动派卡时间模式
$config['duration'] = array(
    '1' => '日期时间',
    '2' => '每日时间'
);
