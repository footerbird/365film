/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : waituicom

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-01-02 17:38:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article_info
-- ----------------------------
DROP TABLE IF EXISTS `article_info`;
CREATE TABLE `article_info` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章编号',
  `article_title` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '文章标题',
  `thumb_path` varchar(1024) CHARACTER SET utf8 NOT NULL COMMENT '缩略图路径',
  `article_lead` varchar(1024) CHARACTER SET utf8 NOT NULL COMMENT '文章导语',
  `article_tag` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '文章标签',
  `article_content` text CHARACTER SET utf8 NOT NULL COMMENT '文章内容',
  `status` int(11) NOT NULL COMMENT '文章状态(已发布？未发布)',
  `author_id` int(11) NOT NULL COMMENT '作者编号',
  `article_category` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '文章类型',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '文章发布时间',
  `article_read` int(11) NOT NULL DEFAULT '0' COMMENT '文章阅读量',
  `description` varchar(1024) CHARACTER SET utf8 DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=gbk;
