/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : mvoice

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2014-07-29 15:07:40
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `voice_file_locations`
-- ----------------------------
DROP TABLE IF EXISTS `voice_file_locations`;
CREATE TABLE `voice_file_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(250) DEFAULT NULL,
  `campaignid` int(11) DEFAULT NULL,
  `state` tinyint(1) DEFAULT '0',
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of voice_file_locations
-- ----------------------------
INSERT INTO voice_file_locations VALUES ('1', '/var/li', '1', '0', null);
INSERT INTO voice_file_locations VALUES ('2', 'ad', '2', '0', null);
