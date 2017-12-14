
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for action_log
-- ----------------------------
DROP TABLE IF EXISTS `action_log`;
CREATE TABLE `action_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) NOT NULL DEFAULT '' COMMENT '操作者名字',
  `module` varchar(128) NOT NULL DEFAULT '' COMMENT '模块名',
  `action` varchar(128) NOT NULL DEFAULT '' COMMENT '具体操作',
  `target` varchar(128) NOT NULL DEFAULT '' COMMENT '被操作的帐号或用户',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '管理员账号',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `ip` varchar(255) NOT NULL DEFAULT '' COMMENT '最后登录IP地址',
  `login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `login_count` mediumint(8) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '账户状态，禁用为0   启用为1',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '127.0.0.1', '2017-11-06 08:10:20', '0', '1', null);

-- ----------------------------
-- Table structure for auth_group
-- ----------------------------
DROP TABLE IF EXISTS `auth_group`;
CREATE TABLE `auth_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `status` smallint(6) NOT NULL DEFAULT '1',
  `rules` varchar(1024) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_group
-- ----------------------------
INSERT INTO `auth_group` VALUES ('1', '超级管理员', '1', '1,2,3,4,5,6,7');

-- ----------------------------
-- Table structure for auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `auth_group_access`;
CREATE TABLE `auth_group_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_group_access
-- ----------------------------
INSERT INTO `auth_group_access` VALUES ('1', '1', '1');


-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL DEFAULT '',
  `title` varchar(20) NOT NULL DEFAULT '',
  `type` smallint(6) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` varchar(100) NOT NULL DEFAULT '',
  `m_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------
INSERT INTO `auth_rule` VALUES ('1', 'user/index', '用户列表', '1', '1', '', '3');
INSERT INTO `auth_rule` VALUES ('2', 'user/addUser', '添加用户', '1', '1', '', '3');
INSERT INTO `auth_rule` VALUES ('3', 'user/editUser', '编辑用户', '1', '1', '', '3');
INSERT INTO `auth_rule` VALUES ('4', 'user/delUser', '删除用户', '1', '1', '', '3');
INSERT INTO `auth_rule` VALUES ('5', 'user/groupList', '权限组管理', '1', '1', '', '4');
INSERT INTO `auth_rule` VALUES ('6', 'user/addGroup', '添加用户组', '1', '1', '', '4');
INSERT INTO `auth_rule` VALUES ('7', 'user/editGroup', '编辑用户组', '1', '1', '', '4');


-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL COMMENT '菜单文字',
  `parent_id` int(11) DEFAULT NULL COMMENT '上级菜单ID',
  `r_id` int(11) DEFAULT NULL COMMENT '规则ID',
  `bg_img` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '首页', '0', '0', 'icon-index');
INSERT INTO `menu` VALUES ('2', '用户管理', '0', '0', 'icon-user');
INSERT INTO `menu` VALUES ('3', '用户列表', '2', '1', null);
INSERT INTO `menu` VALUES ('4', '权限组管理', '2', '5', null);