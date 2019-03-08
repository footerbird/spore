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
-- Table structure for article_info
-- ----------------------------
DROP TABLE IF EXISTS `article_info`;
CREATE TABLE `article_info` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '小说编号',
  `article_route` varchar(11) NOT NULL COMMENT '小说路由（6位随机数）',
  `article_title` varchar(100) NOT NULL COMMENT '小说标题',
  `article_author` varchar(100) NOT NULL COMMENT '小说作者',
  `article_summary` varchar(1024) NOT NULL COMMENT '小说简介',
  `thumb_path` varchar(1024) NOT NULL COMMENT '小说封面',
  `article_type` varchar(100) NOT NULL COMMENT '小说类型',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '小说状态(已发布？未发布)',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '小说发布时间',
  `article_read` int(11) NOT NULL DEFAULT '0' COMMENT '小说访问量',
  `article_score` float(11,1) NOT NULL DEFAULT '0.0' COMMENT '小说评分',
  `description` varchar(1024) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article_info
-- ----------------------------
