/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : spore

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-03-05 15:49:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article_hotword
-- ----------------------------
DROP TABLE IF EXISTS `article_hotword`;
CREATE TABLE `article_hotword` (
  `hotword_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '热搜词编号',
  `hotword_name` varchar(100) NOT NULL COMMENT '热搜词名称',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '热搜词搜索时间',
  `description` varchar(1024) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`hotword_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
