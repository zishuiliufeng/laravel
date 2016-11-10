/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : demo

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-06-14 17:46:01
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of classification
-- ----------------------------
INSERT INTO `classification` VALUES ('1', '学习', '/yunmarker/client/assets/img/1.png', '2016-06-12 11:49:46', null);
INSERT INTO `classification` VALUES ('2', '工作', null, '2016-06-12 15:15:37', null);

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
  `auth_key` varchar(32) NOT NULL COMMENT '自动登录key',
  `password` varchar(64) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL COMMENT '加密密码',
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '重置密码token',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `role` smallint(6) NOT NULL DEFAULT '10' COMMENT '角色等级',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `sex` enum('2','1','0') DEFAULT '0' COMMENT '0:保密;1:男;2:女',
  `created_at` timestamp NOT NULL COMMENT '创建时间',
  `updated_at` timestamp NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `登录名` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'diwang', '', '96e79218965eb72c92a549dd5a330112', '', 'rGZpw7CNXamhc4KwBOG0D90h6UAbFsor_1456475384', '1402646890@qq.com', '10', '10', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES ('2', 'zifeng', '', '96e79218965eb72c92a549dd5a330112', '', null, '1402646891@qq.com', '10', '10', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES ('3', '紫水流枫', '', '96e79218965eb72c92a549dd5a330112', '', null, '888888@qq.com', '10', '10', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES ('4', '紫枫帝王', '', 'd41d8cd98f00b204e9800998ecf8427e', '', null, '778743908@qq.com', '10', '10', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yunmarker
-- ----------------------------
INSERT INTO `yunmarker` VALUES ('1', 'ThinkPHP的增、删、改、查 | 夏日博客', 'http://www.xiariboke.com/soft/289.html', 'http://www.xiariboke.com/wp-content/themes/Ality/img/favicon.ico', '1', '2016-06-12 17:21:14', null);
INSERT INTO `yunmarker` VALUES ('2', '序言 - ThinkPHP3.2完全开发手册', 'http://document.thinkphp.cn/manual_3_2.html#preface', 'http://su.bdimg.com/icon/6000.png', '1', '2016-06-12 16:49:14', '2016-06-12 17:17:41');
INSERT INTO `yunmarker` VALUES ('3', '开始使用 | Amaze UI', 'http://amazeui.org/getting-started?_ver=2.x', 'http://su.bdimg.com/icon/6000.png', '1', '2016-06-12 17:51:22', null);
