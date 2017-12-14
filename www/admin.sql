/* 
* @Author: xiechao
* @Date:   2017-12-13 10:26:36
* @Last Modified by:   xiechao
* @Last Modified time: 2017-12-14 09:58:48
*/

#游戏列表
CREATE TABLE `game_list` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `game` var_char(255) NOT NULL DEFAULT '' COMMENT '游戏名',
    `game_pic` var_char(255) NOT NULL DEFAULT '' COMMENT '游戏图片',
    `qrcode` var_char(255) NOT NULL DEFAULT '' COMMENT '二维码链接',
    `apk_url` var_char(255) NOT NULL DEFAULT '' COMMENT '游戏包链接',
    `version` var_char(128) NOT NULL DEFAULT  '' COMMENT '游戏包版本',
    `status` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '0:下架，1：上架',
    PRIMARY KEY (`id`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#广告表
CREATE TABLE `advert` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `ad_name` var_char(255) NOT NULL DEFAULT '' COMMENT '广告名称',
    `ad_company` var_char(255) NOT NULL DEFAULT '' COMMENT '公司名称',
    `ad_url` var_char(255) NOT NULL DEFAULT '' COMMENT '广告资源链接',
    `status` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '0:下架，1：上架',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#频道表
CREATE TABLE `channel` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `channel_name` var_char(255) NOT NULL DEFAULT '' COMMENT '渠道名',
    `area` var_char(255)  NOT NULL DEFAULT '' COMMENT '区域',
    `game_ids` var_char(1024) NOT NULL DEFAULT '' COMMENT '游戏id集合',
    `advert_ids` var_char(1024) NOT NULL DEFAULT '' COMMENT '广告id集合'
    `on_of` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '开启：1，关闭：0',
    `start_ts` datetime NOT NULL DEFAULT '' COMMENT '开启时间',
    `end_ts`  datetime NOT NULL DEFAULT '' COMMENT '关闭时间',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#设备表
CREATE TABLE `device` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `device_id` var_char(255) NOT NULL DEFAULT '' COMMENT '设备ID',
    `channel_id` int(11) NOT NULL DEFAULT '' COMMENT '渠道id',
    `device` var_char(128) NOT NULL DEFAULT '' COMMENT '设备名',
    `address` var_char(512) NOT NULL DEFAULT '' COMMENT '分布详细地址',
    `status` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '0:未注册，1：已注册',
    `version` var_char(128)
    PRIMARY KEY (`id`),
    KEY `device_id` ('device_id')
    KEY `channel_id` ('channel_id')
) ENGINE=MyISAM DEFAULT CHARSET=utf8;