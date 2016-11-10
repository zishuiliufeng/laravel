/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : demo

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-11-10 11:40:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions` (
  `permissions_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限ID',
  `permissions_name` varchar(100) DEFAULT NULL COMMENT '权限名称',
  `permissions_code` varchar(100) DEFAULT NULL COMMENT '权限编码',
  `module` varchar(100) DEFAULT NULL COMMENT '模块',
  `sidebar` varchar(100) DEFAULT NULL COMMENT '列表模块',
  PRIMARY KEY (`permissions_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
INSERT INTO `admin_permissions` VALUES ('1', '后台权限', 'backstage-permissions', 'index', '权限管理');
INSERT INTO `admin_permissions` VALUES ('2', '前台权限', 'front-end-permissions', 'index', '权限管理');
INSERT INTO `admin_permissions` VALUES ('3', '后台用户', 'backstage-users', 'index', '用户管理');
INSERT INTO `admin_permissions` VALUES ('4', '前台用户', 'front-end-users', 'index', '用户管理');

-- ----------------------------
-- Table structure for `classification`
-- ----------------------------
DROP TABLE IF EXISTS `classification`;
CREATE TABLE `classification` (
  `classification_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `img` mediumtext,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`classification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of classification
-- ----------------------------
INSERT INTO `classification` VALUES ('1', '学习', '/yunmarker/client/uploads/img/1470272554.png', '2016-06-12 11:49:46', '2016-08-04 09:02:34');
INSERT INTO `classification` VALUES ('2', '工作', null, '2016-06-12 15:15:37', null);
INSERT INTO `classification` VALUES ('3', '测试', '/yunmarker/client/uploads/img/1470721637.png', '2016-08-09 13:42:50', '2016-08-09 13:47:17');
INSERT INTO `classification` VALUES ('4', '策划', '/yunmarker/client/uploads/img/1470965571.png', '2016-08-12 09:10:02', '2016-08-12 09:32:51');

-- ----------------------------
-- Table structure for `role`
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `role_name` varchar(255) DEFAULT NULL COMMENT '角色名称',
  `permissions` varchar(100) DEFAULT NULL COMMENT '权限ID',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '超级管理员', '1,2,3,4');
INSERT INTO `role` VALUES ('2', '普通管理员', '2,4');

-- ----------------------------
-- Table structure for `sortlist`
-- ----------------------------
DROP TABLE IF EXISTS `sortlist`;
CREATE TABLE `sortlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sortlist
-- ----------------------------
INSERT INTO `sortlist` VALUES ('1', '1,2,6,5,3,4,7,8,9,10,11,12');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL DEFAULT '' COMMENT '自动登录key',
  `password` varchar(64) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL COMMENT '加密密码',
  `password_reset_token` varchar(255) DEFAULT '' COMMENT '重置密码token',
  `phone` varchar(50) DEFAULT NULL COMMENT '联系电话',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `role` smallint(6) NOT NULL DEFAULT '10' COMMENT '角色等级',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `sex` enum('2','1','0') DEFAULT '0' COMMENT '0:保密;1:男;2:女',
  `created_at` timestamp NOT NULL COMMENT '创建时间',
  `updated_at` timestamp NOT NULL COMMENT '更新时间',
  `last_login_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `登录名` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'diwang', '', '96e79218965eb72c92a549dd5a330112', '', 'rGZpw7CNXamhc4KwBOG0D90h6UAbFsor_1456475384', null, '1402646890@qq.com', '1', '10', '', '0', '0000-00-00 00:00:00', '2016-10-13 16:37:13', '2016-11-07 09:53:38', '192.168.47.49');
INSERT INTO `user` VALUES ('2', 'zifeng', '', '96e79218965eb72c92a549dd5a330112', '', null, null, '1402646891@qq.com', '10', '10', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null, '');
INSERT INTO `user` VALUES ('3', '紫水流枫', '', '96e79218965eb72c92a549dd5a330112', '', null, null, '888888@qq.com', '10', '10', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-11-04 09:31:26', '192.168.47.111');
INSERT INTO `user` VALUES ('4', '紫枫帝王', '', 'd41d8cd98f00b204e9800998ecf8427e', '', null, null, '778743908@qq.com', '2', '10', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-10-11 10:39:56', '');

-- ----------------------------
-- Table structure for `yunmarker`
-- ----------------------------
DROP TABLE IF EXISTS `yunmarker`;
CREATE TABLE `yunmarker` (
  `marker_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` mediumtext,
  `href` mediumtext,
  `icon` mediumtext,
  `classification_id` int(11) DEFAULT '0' COMMENT '分类id',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`marker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yunmarker
-- ----------------------------
INSERT INTO `yunmarker` VALUES ('1', 'ThinkPHP的增、删、改、查 | 夏日博客', 'http://www.xiariboke.com/soft/289.html', 'http://www.xiariboke.com/wp-content/themes/Ality/img/favicon.ico', '1', '2016-06-12 17:21:14', null);
INSERT INTO `yunmarker` VALUES ('2', '序言 - ThinkPHP3.2完全开发手册', 'http://document.thinkphp.cn/manual_3_2.html#preface', 'http://su.bdimg.com/icon/6000.png', '1', '2016-06-12 16:49:14', '2016-06-12 17:17:41');
INSERT INTO `yunmarker` VALUES ('3', '开始使用 | Amaze UI', 'http://amazeui.org/getting-started?_ver=2.x', 'http://su.bdimg.com/icon/6000.png', '1', '2016-06-12 17:51:22', null);
INSERT INTO `yunmarker` VALUES ('4', '全局 CSS 样式 &middot; Bootstrap v3 中文文档    ', 'http://v3.bootcss.com/css/#tables', 'http://su.bdimg.com/icon/6000.png', '1', '2016-07-29 15:04:56', null);
INSERT INTO `yunmarker` VALUES ('6', 'Thinkphp&nbsp;CURD&nbsp;增&nbsp;删&nbsp;改&nbsp;查_掌控手_新浪博客', 'http://blog.sina.com.cn/s/blog_9a06890901015n2b.html', '/yunmarker/client/assets/img/icon.jpg', '1', '2016-08-08 10:56:00', null);
INSERT INTO `yunmarker` VALUES ('7', '序言 - ThinkPHP3.2完全开发手册', 'http://document.thinkphp.cn/manual_3_2.html#url', '/yunmarker/client/assets/img/icon.jpg', '1', '2016-08-08 11:37:40', null);
INSERT INTO `yunmarker` VALUES ('8', '图片浏览插件', 'https://github.com/fancyapps/fancyBox', '/yunmarker/client/assets/img/icon.jpg', '1', '2016-08-08 16:31:30', null);
INSERT INTO `yunmarker` VALUES ('9', 'v5.5 学生运营-学生端', 'http://ztv8.dev.anoah.com/index.php?m=doc&f=view&docID=15', '/yunmarker/client/assets/img/icon.jpg', '4', '2016-08-12 09:34:04', null);
INSERT INTO `yunmarker` VALUES ('10', '电子书包v5.5 wiki', 'http://wiki.dev.anoah.com/index.php?title=%E7%94%B5%E5%AD%90%E4%B9%A6%E5%8C%85/v5.5', 'http://wiki.dev.anoah.com/index.php?title=%E7%94%B5%E5%AD%90%E4%B9%A6%E5%8C%85/v5.5/favicon.ico', '2', '2016-08-12 09:35:20', null);
INSERT INTO `yunmarker` VALUES ('11', '电子书包v5.5 备课平台/个人中心 原型', 'http://u.dev.anoah.com/cehua/01%E4%BA%A7%E5%93%81%E6%B1%87%E6%80%BB/01%e5%a4%87%e8%af%be%e5%b9%b3%e5%8f%b0/3-%e5%8e%9f%e5%9e%8b%e8%ae%be%e8%ae%a1/%e5%a4%87%e8%af%be%e5%b9%b3%e5%8f%b0V5.5/V5.5%e7%94%b5%e5%ad%90%e4%b9%a6%e5%8c%85%ef%bc%88%e5%a4%87%e8%af%be%e7%ae%a1%e7%90%86%e3%80%81%e4%b8%aa%e4%ba%ba%e4%b8%ad%e5%bf%83%ef%bc%89/#p=%E6%88%91%E7%9A%84%E6%B6%88%E6%81%AF-%E7%B3%BB%E7%BB%9F%E9%80%9A%E7%9F%A5', '/yunmarker/client/assets/img/icon.jpg', '2', '2016-08-12 09:37:10', null);
INSERT INTO `yunmarker` VALUES ('12', '电子书包v5.5 个人中心/消息', 'http://192.168.46.251/cehua/01%E4%BA%A7%E5%93%81%E6%B1%87%E6%80%BB/01%e5%a4%87%e8%af%be%e5%b9%b3%e5%8f%b0/3-%e5%8e%9f%e5%9e%8b%e8%ae%be%e8%ae%a1/%e5%a4%87%e8%af%be%e5%b9%b3%e5%8f%b0V5.5/V5.5%e7%94%b5%e5%ad%90%e4%b9%a6%e5%8c%85%ef%bc%88%e5%a4%87%e8%af%be%e7%ae%a1%e7%90%86%e3%80%81%e4%b8%aa%e4%ba%ba%e4%b8%ad%e5%bf%83%ef%bc%89/#p=%E6%88%91%E7%9A%84%E7%A7%AF%E5%88%86-%E6%8C%89%E7%B1%BB%E5%9E%8B%E6%9F%A5%E7%9C%8B-%E8%B5%84%E6%BA%90%E7%B1%BB', '/yunmarker/client/assets/img/icon.jpg', '2', '2016-08-12 09:39:15', null);
INSERT INTO `yunmarker` VALUES ('13', '电子书包v5.5 积分管理后台', 'http://ztv8.dev.anoah.com/index.php?m=doc&f=view&docID=18', '/yunmarker/client/assets/img/icon.jpg', '2', '2016-08-12 09:39:58', '2016-08-26 10:54:48');
INSERT INTO `yunmarker` VALUES ('14', 'GitHub - php-curl-class/php-curl-class: PHP Curl Class makes it easy to send HTTP requests and integrate with web APIs', 'https://github.com/php-curl-class/php-curl-class', '/yunmarker/client/assets/img/icon.jpg', '1', '2016-08-17 15:11:49', null);
INSERT INTO `yunmarker` VALUES ('15', 'php扩展memcache的安装', 'http://www.jb51.net/article/73879.htm', '/yunmarker/client/assets/img/icon.jpg', '1', '2016-09-12 11:49:36', null);
INSERT INTO `yunmarker` VALUES ('16', '全屏图片展示', 'http://www.sucaihuo.com/js/67.html', 'http://www.sucaihuo.com/js/67.html/Public/images/favicon.ico', '1', '2016-09-22 14:06:11', null);
INSERT INTO `yunmarker` VALUES ('17', 'js键值对数组', 'https://segmentfault.com/q/1010000006692517?_ea=1098903', 'https://sf-static.b0.upaiyun.com/v-5803ab99/global/img/favicon.ico', '1', '2016-10-18 14:42:13', null);
INSERT INTO `yunmarker` VALUES ('18', 'git 教程', 'http://www.liaoxuefeng.com/wiki/0013739516305929606dd18361248578c67b8067c8c017b000/0013752340242354807e192f02a44359908df8a5643103a000', '/yunmarker/client/assets/img/icon.jpg', '1', '2016-11-07 17:36:53', null);
