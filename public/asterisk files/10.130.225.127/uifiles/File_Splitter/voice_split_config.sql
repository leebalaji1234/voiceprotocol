/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : mvoice

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2014-07-29 15:07:15
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `voice_split_config`
-- ----------------------------
DROP TABLE IF EXISTS `voice_split_config`;
CREATE TABLE `voice_split_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_query` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of voice_split_config
-- ----------------------------
INSERT INTO voice_split_config VALUES ('1', 'CREATE TABLE `<TABLENAME>` (\r\n  `subid` bigint(11) NOT NULL AUTO_INCREMENT,\r\n  `msisdn` bigint(20) DEFAULT NULL,\r\n  `campid` bigint(11) DEFAULT NULL,\r\n  `audio_clip` varchar(128) DEFAULT NULL,\r\n  `isbuffer` smallint(2) DEFAULT NULL,\r\n  `retry` smallint(2) DEFAULT NULL,\r\n  `sch_time` datetime DEFAULT NULL,\r\n  `status` smallint(2) DEFAULT \'0\',\r\n  `template_id` int(11) DEFAULT NULL,\r\n  `user_acc_type` enum(\'Promo\',\'transaction\',\'ftp\',\'http\') DEFAULT NULL,\r\n  `process_state` smallint(2) DEFAULT NULL COMMENT \'1-user;2-maker;3-picked;4-dialed\',\r\n  `user_id` bigint(11) DEFAULT NULL,\r\n  `created` datetime DEFAULT NULL,\r\n  `tts` text,\r\n  `agent_number` varchar(20) DEFAULT NULL,\r\n  PRIMARY KEY (`subid`)\r\n) ENGINE=MyISAM AUTO_INCREMENT=2414538 DEFAULT CHARSET=latin1;');
