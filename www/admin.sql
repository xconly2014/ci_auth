/* 
* @Author: xiechao
* @Date:   2017-12-13 10:26:36
* @Last Modified by:   xiechao
* @Last Modified time: 2017-12-14 18:22:39
*/

#游戏列表
CREATE TABLE `game_list` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `game` varchar(255) NOT NULL DEFAULT '' COMMENT '游戏名',
    `game_pic` varchar(255) NOT NULL DEFAULT '' COMMENT '游戏图片',
    `qrcode` varchar(255) NOT NULL DEFAULT '' COMMENT '二维码链接',
    `apk_url` varchar(255) NOT NULL DEFAULT '' COMMENT '游戏包链接',
    `version` varchar(128) NOT NULL DEFAULT  '' COMMENT '游戏包版本',
    `status` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '0:下架，1：上架',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#广告表
CREATE TABLE `advert` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `ad_name` varchar(255) NOT NULL DEFAULT '' COMMENT '广告名称',
    `ad_company` varchar(255) NOT NULL DEFAULT '' COMMENT '公司名称',
    `ad_url` varchar(255) NOT NULL DEFAULT '' COMMENT '广告资源链接',
    `status` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '0:下架，1：上架',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#频道表
CREATE TABLE `channel` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `channel_name` varchar(255) NOT NULL DEFAULT '' COMMENT '渠道名',
    `area` varchar(255)  NOT NULL DEFAULT '' COMMENT '区域',
    `game_ids` varchar(1024) NOT NULL DEFAULT '' COMMENT '游戏id集合',
    `advert_ids` varchar(1024) NOT NULL DEFAULT '' COMMENT '广告id集合',
    `on_of` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '开启：1，关闭：0',
    `start_ts` datetime DEFAULT NULL COMMENT '开启时间',
    `end_ts`  datetime DEFAULT NULL COMMENT '关闭时间',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#设备表
CREATE TABLE `device` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `device_id` varchar(255) NOT NULL DEFAULT '' COMMENT '设备ID',
    `channel_id` int(11) NOT NULL DEFAULT 0 COMMENT '渠道id',
    `device` varchar(128) NOT NULL DEFAULT '' COMMENT '设备名',
    `address` varchar(512) NOT NULL DEFAULT '' COMMENT '分布详细地址',
    `status` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '0:未注册，1：已注册',
    `version` varchar(128) NOT NULL DEFAULT '' COMMENT '设备版本',
    PRIMARY KEY (`id`),
    KEY `device_id` (`device_id`),
    KEY `channel_id` (`channel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;