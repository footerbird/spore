/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : spore

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-03-08 13:59:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for chapter_info
-- ----------------------------
DROP TABLE IF EXISTS `chapter_info`;
CREATE TABLE `chapter_info` (
  `chapter_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '章节编号',
  `chapter_order` int(11) NOT NULL COMMENT '章节顺序',
  `chapter_route` varchar(11) NOT NULL COMMENT '章节路由（6位随机数）',
  `chapter_title` varchar(100) NOT NULL COMMENT '章节标题',
  `chapter_content` varchar(1024) NOT NULL COMMENT '章节内容',
  `article_route` varchar(11) NOT NULL COMMENT '小说路由（6位随机数）',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '章节状态(已发布？未发布)',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '章节发布时间',
  `description` varchar(1024) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`chapter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
