
-- ----------------------------
-- Table structure for yz_authorities
-- ----------------------------
DROP TABLE IF EXISTS `yz_authorities`;
CREATE TABLE `yz_authorities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(50) DEFAULT NULL,
  `auth_describle` text NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='基本权限表';

-- ----------------------------
-- Records of yz_authorities
-- ----------------------------
INSERT INTO `yz_authorities` VALUES ('1', '', '用户权限', '0', '2017-06-15 14:51:50', '2017-06-15 14:51:50');
INSERT INTO `yz_authorities` VALUES ('2', '', '用户管理', '1', '2017-06-15 14:57:03', '2017-06-15 14:57:03');
INSERT INTO `yz_authorities` VALUES ('3', 'Users/index', '用户列表', '2', '2017-06-15 14:59:29', '2017-06-15 14:59:29');
INSERT INTO `yz_authorities` VALUES ('4', '', '角色管理', '1', '2017-06-15 15:00:26', '2017-06-15 15:00:26');
INSERT INTO `yz_authorities` VALUES ('5', 'Roles/index', '角色列表', '4', '2017-06-15 15:00:48', '2017-06-15 15:00:48');
INSERT INTO `yz_authorities` VALUES ('6', '', '权限管理', '1', '2017-06-15 15:01:08', '2017-06-15 15:01:08');
INSERT INTO `yz_authorities` VALUES ('7', 'Authorities/index', '权限列表', '6', '2017-06-15 15:01:33', '2017-06-15 15:01:33');
INSERT INTO `yz_authorities` VALUES ('8', '', '菜单管理', '1', '2017-06-15 15:01:57', '2017-06-15 15:01:57');
INSERT INTO `yz_authorities` VALUES ('9', 'Menus/index', '菜单列表', '8', '2017-06-15 15:02:24', '2017-06-15 15:02:24');
INSERT INTO `yz_authorities` VALUES ('10', '', '基础权限', '0', '2017-06-15 15:03:22', '2017-06-15 15:03:22');
INSERT INTO `yz_authorities` VALUES ('11', 'Users/usercenter', '个人中心', '10', '2017-06-15 15:04:21', '2017-06-15 15:04:21');
INSERT INTO `yz_authorities` VALUES ('12', 'Index/index', '后台首页', '10', '2017-06-15 15:05:01', '2017-06-15 15:04:44');

-- ----------------------------
-- Table structure for yz_authorities_roles
-- ----------------------------
DROP TABLE IF EXISTS `yz_authorities_roles`;
CREATE TABLE `yz_authorities_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authority_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yz_authorities_roles
-- ----------------------------

-- ----------------------------
-- Table structure for yz_menu_roles
-- ----------------------------
DROP TABLE IF EXISTS `yz_menu_roles`;
CREATE TABLE `yz_menu_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yz_menu_roles
-- ----------------------------

-- ----------------------------
-- Table structure for yz_menus
-- ----------------------------
DROP TABLE IF EXISTS `yz_menus`;
CREATE TABLE `yz_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `icon` varchar(50) NOT NULL DEFAULT '' COMMENT 'icon 标签属性',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `path` varchar(100) NOT NULL DEFAULT '' COMMENT '路径',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `is_show` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Records of yz_menus
-- ----------------------------
INSERT INTO `yz_menus` VALUES ('1', 'icon-sitemap', '用户权限', '', '0', '10', '1', '2017-06-14 11:20:35');
INSERT INTO `yz_menus` VALUES ('2', '', '用户管理', '', '1', '0', '1', '0000-00-00 00:00:00');
INSERT INTO `yz_menus` VALUES ('3', '', '角色管理', '', '1', '0', '1', '0000-00-00 00:00:00');
INSERT INTO `yz_menus` VALUES ('4', '', '权限管理', '', '1', '0', '1', '0000-00-00 00:00:00');
INSERT INTO `yz_menus` VALUES ('5', '', '菜单管理', '', '1', '0', '1', '0000-00-00 00:00:00');
INSERT INTO `yz_menus` VALUES ('6', '', '用户列表', '/Users/index', '2', '0', '1', '0000-00-00 00:00:00');
INSERT INTO `yz_menus` VALUES ('7', '', '添加用户', '/Users/add', '2', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `yz_menus` VALUES ('9', '', '角色列表', '/Roles/index', '3', '0', '1', '0000-00-00 00:00:00');
INSERT INTO `yz_menus` VALUES ('10', '', '添加角色', '/Roles/add', '3', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `yz_menus` VALUES ('11', '', '权限列表', '/Authorities/index', '4', '0', '1', '0000-00-00 00:00:00');
INSERT INTO `yz_menus` VALUES ('12', '', '添加权限', '/Authorities/add', '4', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `yz_menus` VALUES ('13', '', '角色权限', '/Roles/auth', '3', '0', '1', '0000-00-00 00:00:00');
INSERT INTO `yz_menus` VALUES ('14', '', '菜单列表', '/Menus/index', '5', '0', '1', '0000-00-00 00:00:00');
INSERT INTO `yz_menus` VALUES ('15', '', '添加菜单', '/Menus/add', '5', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `yz_menus` VALUES ('16', '', '角色菜单', '/Menus/rol_menu', '3', '0', '1', '0000-00-00 00:00:00');
INSERT INTO `yz_menus` VALUES ('17', 'icon-compass', '哥哥', '', '0', '10', '1', '2017-06-15 15:32:22');
INSERT INTO `yz_menus` VALUES ('18', '', '顶顶顶顶', '/Index/index', '17', '10', '1', '2017-06-15 15:34:19');
INSERT INTO `yz_menus` VALUES ('19', '', '角色编辑', '/Roles/rol_edit', '3', '10', '2', '2017-06-15 17:06:22');
INSERT INTO `yz_menus` VALUES ('20', '', '角色详情', '/Roles/rol_detail', '3', '10', '2', '2017-06-15 17:06:56');

-- ----------------------------
-- Table structure for yz_roles
-- ----------------------------
DROP TABLE IF EXISTS `yz_roles`;
CREATE TABLE `yz_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  `role_describle` text NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='角色信息表';

-- ----------------------------
-- Records of yz_roles
-- ----------------------------
INSERT INTO `yz_roles` VALUES ('1', '超级管理员', '超级管理员', '2017-06-16 10:32:22');

-- ----------------------------
-- Table structure for yz_users
-- ----------------------------
DROP TABLE IF EXISTS `yz_users`;
CREATE TABLE `yz_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `loginname` varchar(20) NOT NULL DEFAULT '' COMMENT '用户登陆名称',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '姓名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '用户密码',
  `sex` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '性别 1男 2女',
  `telphone` varchar(11) DEFAULT '' COMMENT '电话',
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱',
  `birthday` varchar(13) DEFAULT '0' COMMENT '生日',
  `id_card` varchar(20) DEFAULT '0' COMMENT '身份证',
  `is_login` tinyint(4) DEFAULT '1' COMMENT '是否允许登陆 1正常 0禁用',
  `role_id` int(10) unsigned DEFAULT '0' COMMENT '角色ID',
  `face` varchar(100) DEFAULT '' COMMENT '头像1',
  `describe` text COMMENT '个人简介',
  `modified` datetime NOT NULL,
  `last_login_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后登录时间',
  `last_login_ip` varchar(20) DEFAULT NULL COMMENT '最后登录ip',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='平台用户表';

-- ----------------------------
-- Records of yz_users
-- ----------------------------
INSERT INTO `yz_users` VALUES ('1', 'admin', '超级管理员', '$2a$10$tK.cIvBd4ymkjjzVbp.e/evyRVjh4Rnp0UzN56FRD3LRFaSDkXd/S', '2', '', 'wuhuang@qq.com', '2017-06-15', '1111111111111111111', '1', '1', '', '王企鹅无群二无群若群无', '2017-06-16 10:31:45', '2017-06-14 17:02:48', '0', '2017-06-16 10:31:18');
