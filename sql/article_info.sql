/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : 365film

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-01-03 09:18:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article_info
-- ----------------------------
DROP TABLE IF EXISTS `article_info`;
CREATE TABLE `article_info` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '电影编号',
  `article_route` varchar(11) CHARACTER SET utf8 NOT NULL COMMENT '电影路由（6位随机数）',
  `article_title` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '电影标题',
  `thumb_path` varchar(1024) CHARACTER SET utf8 NOT NULL COMMENT '缩略图路径',
  `poster_path` varchar(1024) CHARACTER SET utf8 NOT NULL COMMENT '海报路径',
  `article_nation` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '电影国家',
  `article_type` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '电影类型',
  `article_content` text CHARACTER SET utf8 NOT NULL COMMENT '电影内容',
  `status` int(11) NOT NULL COMMENT '电影状态(已发布？未发布)',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '电影发布时间',
  `article_read` int(11) NOT NULL DEFAULT '0' COMMENT '电影访问量',
  `description` varchar(1024) CHARACTER SET utf8 DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=gbk;
