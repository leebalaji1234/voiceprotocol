CREATE DATABASE  IF NOT EXISTS `mVoice` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mVoice`;
-- MySQL dump 10.13  Distrib 5.6.19, for debian-linux-gnu (x86_64)
--
-- Host: 10.130.225.126    Database: mVoice
-- ------------------------------------------------------
-- Server version	5.1.73

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `audio_library`
--

DROP TABLE IF EXISTS `audio_library`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audio_library` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `actual_clip_name` varchar(128) DEFAULT NULL,
  `system_clip_name` varchar(128) DEFAULT NULL,
  `clip_path` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  `clip_param` text,
  `audio_name` varchar(32) NOT NULL,
  `audio_description` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audio_library`
--

LOCK TABLES `audio_library` WRITE;
/*!40000 ALTER TABLE `audio_library` DISABLE KEYS */;
INSERT INTO `audio_library` VALUES (1,'1423661782.wav','1423662242-7931.wav','audio/1/1423662242-7931.wav',1,'2015-02-11 13:44:02',1,NULL,'1423661782',''),(2,'1423661782.wav','1423662499-3540.wav','audio/1/1423662499-3540.wav',1,'2015-02-11 13:48:19',1,NULL,'1423661782',''),(3,'1423661782.wav','1423662864-2233.wav','audio/1/1423662864-2233.wav',1,'2015-02-11 13:54:24',1,NULL,'1423661782',''),(4,'1423661782.wav','1423663002-5470.wav','audio/1/1423663002-5470.wav',1,'2015-02-11 13:56:42',1,NULL,'1423661782',''),(5,'1423661782.wav','1423663242-4966.wav','audio/1/1423663242-4966.wav',1,'2015-02-11 14:00:42',1,NULL,'1423661782',''),(6,'1423661782.wav','1423663821-5867.wav','audio/1/1423663821-5867.wav',1,'2015-02-11 14:10:21',1,NULL,'1423661782',''),(7,'1423661782.wav','1423663907-7872.wav','audio/1/1423663907-7872.wav',1,'2015-02-11 14:11:47',1,NULL,'1423661782',''),(8,'1423661782.wav','1423663973-2712.wav','audio/1/1423663973-2712.wav',1,'2015-02-11 14:12:53',1,NULL,'1423661782',''),(9,'1423661782.wav','1423664003-1392.wav','audio/1/1423664003-1392.wav',1,'2015-02-11 14:13:23',1,NULL,'1423661782',''),(10,'1423661782.wav','1423664048-8387.wav','audio/1/1423664048-8387.wav',1,'2015-02-11 14:14:08',1,NULL,'1423661782',''),(11,'1423661782.wav','1423664182-9160.wav','audio/1/1423664182-9160.wav',1,'2015-02-11 14:16:22',1,NULL,'1423661782',''),(12,'1423661782.wav','1423664211-1979.wav','audio/1/1423664211-1979.wav',1,'2015-02-11 14:16:51',1,NULL,'1423661782',''),(13,'1423661782.wav','1423664287-7365.wav','audio/1/1423664287-7365.wav',1,'2015-02-11 14:18:07',1,NULL,'1423661782',''),(14,'output1.wav','1423664835-9879.wav','audio/1/1423664835-9879.wav',1,'2015-02-11 14:27:15',1,NULL,'output1',''),(15,'1423661782.wav','1423665017-3517.wav','audio/1/1423665017-3517.wav',1,'2015-02-11 14:30:17',1,NULL,'1423661782',''),(16,'1423661782.wav','1423668387-6192.wav','audio/1/1423668387-6192.wav',1,'2015-02-11 15:26:27',1,NULL,'1423661782',''),(17,'output1.wav','1423735054-9593.wav','audio/8/1423735054-9593.wav',8,'2015-02-12 09:57:34',1,NULL,'output1',''),(18,'output1.wav','1423735578-4970.wav','audio/8/1423735578-4970.wav',8,'2015-02-12 10:06:18',1,NULL,'output1',''),(19,'output1.wav','1423735998-5918.wav','audio/8/1423735998-5918.wav',8,'2015-02-12 10:13:18',1,NULL,'output1',''),(20,'output1.wav','1423736534-6159.wav','audio/8/1423736534-6159.wav',8,'2015-02-12 10:22:14',1,NULL,'output1',''),(21,'output1.wav','1423736585-7758.wav','audio/8/1423736585-7758.wav',8,'2015-02-12 10:23:05',1,NULL,'output1',''),(22,'output1.wav','1423736662-1569.wav','audio/8/1423736662-1569.wav',8,'2015-02-12 10:24:22',1,NULL,'output1',''),(23,'output1.wav','1423736867-2426.wav','audio/8/1423736867-2426.wav',8,'2015-02-12 10:27:47',1,NULL,'output1',''),(24,'moto_v3_wav.wav','1423746490-2093.wav','audio/8/1423746490-2093.wav',8,'2015-02-12 13:08:10',1,NULL,'output1',''),(25,'2_fast_2_furios.wav','1423746490-1919.wav','audio/8/1423746490-1919.wav',8,'2015-02-12 13:08:10',1,NULL,'output1',''),(26,'output1.wav','1423746490-3547.wav','audio/8/1423746490-3547.wav',8,'2015-02-12 13:08:10',1,NULL,'output1',''),(27,'moto_v3_wav.wav','1423747135-8885.wav','audio/8/1423747135-8885.wav',8,'2015-02-12 13:18:55',1,NULL,'moto_v3_wav',''),(28,'1423661782.wav','1423748435-8363.wav','audio/8/1423748435-8363.wav',8,'2015-02-12 13:40:35',1,NULL,'1423661782',''),(29,'1.wav','1423748498-6593.wav','audio/8/1423748498-6593.wav',8,'2015-02-12 13:41:38',1,NULL,'3',''),(30,'2.wav','1423748498-8933.wav','audio/8/1423748498-8933.wav',8,'2015-02-12 13:41:38',1,NULL,'3',''),(31,'3.wav','1423748498-5183.wav','audio/8/1423748498-5183.wav',8,'2015-02-12 13:41:38',1,NULL,'3',''),(32,'2_1_C.wav','1423748583-6854.wav','audio/8/1423748583-2997.wav',8,'2015-02-12 13:43:03',1,NULL,'6_2_H',''),(33,'6_1_A.wav','1423748583-2997.wav','audio/8/1423748583-6854.wav',8,'2015-02-12 13:43:03',1,NULL,'6_2_H',''),(34,'6_2_H.wav','1423748583-3087.wav','audio/8/1423748583-3087.wav',8,'2015-02-12 13:43:03',1,NULL,'6_2_H',''),(35,'1.wav','1423748698-9191.wav','audio/8/1423748698-9191.wav',8,'2015-02-12 13:44:58',1,NULL,'6_2_A',''),(36,'2.wav','1423748698-4425.wav','audio/8/1423748698-4425.wav',8,'2015-02-12 13:44:58',1,NULL,'6_2_A',''),(37,'2_2_B.wav','1423748698-2359.wav','audio/8/1423748698-2359.wav',8,'2015-02-12 13:44:58',1,NULL,'6_2_A',''),(38,'6_2_A.wav','1423748698-1773.wav','audio/8/1423748698-1773.wav',8,'2015-02-12 13:44:58',1,NULL,'6_2_A',''),(39,'1.wav','1423748730-4443.wav','audio/8/1423748730-4443.wav',8,'2015-02-12 13:45:30',1,NULL,'6_2_A',''),(40,'2.wav','1423748730-5111.wav','audio/8/1423748730-5111.wav',8,'2015-02-12 13:45:30',1,NULL,'6_2_A',''),(41,'2_2_B.wav','1423748730-6092.wav','audio/8/1423748730-6092.wav',8,'2015-02-12 13:45:30',1,NULL,'6_2_A',''),(42,'6_2_A.wav','1423748730-9046.wav','audio/8/1423748730-9046.wav',8,'2015-02-12 13:45:30',1,NULL,'6_2_A',''),(43,'1.wav','1423748886-3239.wav','audio/8/1423748886-3239.wav',8,'2015-02-12 13:48:06',1,NULL,'6_2_B',''),(44,'2.wav','1423748886-2893.wav','audio/8/1423748886-2893.wav',8,'2015-02-12 13:48:06',1,NULL,'6_2_B',''),(45,'6_1_A.wav','1423748886-4589.wav','audio/8/1423748886-4589.wav',8,'2015-02-12 13:48:06',1,NULL,'6_2_B',''),(46,'6_2_B.wav','1423748886-1092.wav','audio/8/1423748886-1092.wav',8,'2015-02-12 13:48:06',1,NULL,'6_2_B',''),(47,'3.wav','1423808874-7110.wav','audio/8/1423808874-7110.wav',8,'2015-02-13 06:27:54',1,NULL,'7',''),(48,'1.wav','1423808874-2587.wav','audio/8/1423808874-2587.wav',8,'2015-02-13 06:27:54',1,NULL,'7',''),(49,'7.wav','1423808874-5158.wav','audio/8/1423808874-5158.wav',8,'2015-02-13 06:27:54',1,NULL,'7',''),(50,'3.wav','1423810609-4004.wav','audio/8/1423810609-4004.wav',8,'2015-02-13 06:56:49',1,NULL,'7',''),(51,'1.wav','1423810609-6346.wav','audio/8/1423810609-6346.wav',8,'2015-02-13 06:56:49',1,NULL,'7',''),(52,'7.wav','1423810609-5611.wav','audio/8/1423810609-5611.wav',8,'2015-02-13 06:56:49',1,NULL,'7',''),(53,'3.wav','1423810701-2696.wav','audio/8/1423810701-2696.wav',8,'2015-02-13 06:58:21',1,NULL,'7',''),(54,'1.wav','1423810701-8539.wav','audio/8/1423810701-8539.wav',8,'2015-02-13 06:58:21',1,NULL,'7',''),(55,'7.wav','1423810701-3762.wav','audio/8/1423810701-3762.wav',8,'2015-02-13 06:58:21',1,NULL,'7',''),(56,'3.wav','1423811937-6044.wav','audio/8/1423811937-6044.wav',8,'2015-02-13 07:18:57',1,NULL,'7',''),(57,'1.wav','1423811937-8198.wav','audio/8/1423811937-8198.wav',8,'2015-02-13 07:18:57',1,NULL,'7',''),(58,'7.wav','1423811937-6876.wav','audio/8/1423811937-6876.wav',8,'2015-02-13 07:18:57',1,NULL,'7',''),(59,'3.wav','1423812120-2910.wav','audio/8/1423812120-2910.wav',8,'2015-02-13 07:22:00',1,NULL,'7',''),(60,'1.wav','1423812120-1565.wav','audio/8/1423812120-1565.wav',8,'2015-02-13 07:22:00',1,NULL,'7',''),(61,'7.wav','1423812120-9493.wav','audio/8/1423812120-9493.wav',8,'2015-02-13 07:22:00',1,NULL,'7',''),(62,'3.wav','1423812567-3971.wav','audio/8/1423812567-3971.wav',8,'2015-02-13 07:29:27',1,NULL,'7',''),(63,'1.wav','1423812567-2727.wav','audio/8/1423812567-2727.wav',8,'2015-02-13 07:29:27',1,NULL,'7',''),(64,'7.wav','1423812567-1672.wav','audio/8/1423812567-1672.wav',8,'2015-02-13 07:29:27',1,NULL,'7',''),(65,'3.wav','1423812682-3428.wav','audio/8/1423812682-3428.wav',8,'2015-02-13 07:31:22',1,NULL,'7',''),(66,'1.wav','1423812682-5448.wav','audio/8/1423812682-5448.wav',8,'2015-02-13 07:31:22',1,NULL,'7',''),(67,'7.wav','1423812682-5542.wav','audio/8/1423812682-5542.wav',8,'2015-02-13 07:31:22',1,NULL,'7',''),(68,'6_2_A.wav','1423813017-2262.wav','audio/8/1423813017-2262.wav',8,'2015-02-13 07:36:57',1,NULL,'10',''),(69,'10.wav','1423813017-2869.wav','audio/8/1423813017-2869.wav',8,'2015-02-13 07:36:57',1,NULL,'10',''),(70,'10.wav','1423813017-3245.wav','audio/8/1423813017-3245.wav',8,'2015-02-13 07:36:57',1,NULL,'10',''),(71,'6_1_A.wav','1423813109-2473.wav','audio/8/1423813109-2473.wav',8,'2015-02-13 07:38:29',1,NULL,'2',''),(72,'6_2_E.wav','1423813109-4571.wav','audio/8/1423813109-4571.wav',8,'2015-02-13 07:38:29',1,NULL,'2',''),(73,'1.wav','1423813109-5072.wav','audio/8/1423813109-5072.wav',8,'2015-02-13 07:38:29',1,NULL,'2',''),(74,'2.wav','1423813109-3892.wav','audio/8/1423813109-3892.wav',8,'2015-02-13 07:38:29',1,NULL,'2',''),(75,'1.wav','1423813531-2603.wav','audio/8/1423813531-2603.wav',8,'2015-02-13 07:45:31',1,NULL,'4',''),(76,'2.wav','1423813531-8611.wav','audio/8/1423813531-8611.wav',8,'2015-02-13 07:45:31',1,NULL,'4',''),(77,'3.wav','1423813531-9498.wav','audio/8/1423813531-9498.wav',8,'2015-02-13 07:45:31',1,NULL,'4',''),(78,'4.wav','1423813531-8158.wav','audio/8/1423813531-8158.wav',8,'2015-02-13 07:45:31',1,NULL,'4',''),(79,'1.wav','1423813666-1257.wav','audio/8/1423813666-1257.wav',8,'2015-02-13 07:47:47',1,NULL,'4',''),(80,'2.wav','1423813666-8834.wav','audio/8/1423813666-8834.wav',8,'2015-02-13 07:47:47',1,NULL,'4',''),(81,'3.wav','1423813666-6365.wav','audio/8/1423813666-6365.wav',8,'2015-02-13 07:47:47',1,NULL,'4',''),(82,'4.wav','1423813666-5166.wav','audio/8/1423813666-5166.wav',8,'2015-02-13 07:47:47',1,NULL,'4',''),(83,'output1.wav','1423824234-5062.wav','audio/8/1423824234-5062.wav',8,'2015-02-13 10:43:54',1,NULL,'output1',''),(84,'output1.wav','1424952513-9267.wav','audio/8/1424952513-9267.wav',8,'2015-02-26 12:08:33',1,NULL,'output1',''),(85,'output1.wav','1424952636-7971.wav','audio/8/1424952636-7971.wav',8,'2015-02-26 12:10:36',1,NULL,'output1',''),(86,'output1.wav','1424953245-4072.wav','audio/8/1424953245-4072.wav',8,'2015-02-26 12:20:45',1,NULL,'output1',''),(87,'output1.wav','1424954202-4255.wav','audio/8/1424954202-4255.wav',8,'2015-02-26 12:36:42',1,NULL,'output1',''),(88,'output1.wav','1424954330-9631.wav','audio/8/1424954330-9631.wav',8,'2015-02-26 12:38:50',1,NULL,'output1',''),(89,'amy.wav','1429188613-6984.wav','audio/11/1429188613-6984.wav',11,'2015-04-16 12:50:13',1,NULL,'amy',''),(90,'','','',11,'2015-04-16 12:59:37',1,NULL,'','');
/*!40000 ALTER TABLE `audio_library` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `callback`
--

DROP TABLE IF EXISTS `callback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `callback` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `called_number` varchar(20) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `obdrecord_id` bigint(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `call_starttime` datetime DEFAULT NULL,
  `call_endtime` datetime DEFAULT NULL,
  `call_duration` int(11) DEFAULT NULL,
  `user_keypress` varchar(64) DEFAULT NULL,
  `dial_status` varchar(64) DEFAULT NULL,
  `retry_count` int(11) DEFAULT NULL,
  `last_clip` varchar(128) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `agent_number` varchar(20) DEFAULT NULL,
  `bridge_status` varchar(64) DEFAULT NULL,
  `bridge_duration` int(11) DEFAULT NULL,
  `urlstatus` int(11) DEFAULT '0',
  `urlresponse` varchar(1024) DEFAULT NULL,
  `handoverattempt` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=337703 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `callback`
--

LOCK TABLES `callback` WRITE;
/*!40000 ALTER TABLE `callback` DISABLE KEYS */;
/*!40000 ALTER TABLE `callback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `callback_attempt_log`
--

DROP TABLE IF EXISTS `callback_attempt_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `callback_attempt_log` (
  `id` bigint(20) DEFAULT NULL,
  `called_number` varchar(20) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ts` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `handoverattempt` int(2) DEFAULT NULL,
  `error` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `callback_attempt_log`
--

LOCK TABLES `callback_attempt_log` WRITE;
/*!40000 ALTER TABLE `callback_attempt_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `callback_attempt_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `camp_name` varchar(64) DEFAULT NULL,
  `csv_count` int(11) DEFAULT NULL,
  `schedule_time` datetime DEFAULT NULL,
  `retry` int(11) DEFAULT NULL,
  `audio_clip` varchar(1024) DEFAULT NULL,
  `csv_file` varchar(128) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `isbuffer` smallint(2) DEFAULT '0',
  `template_id` smallint(6) DEFAULT NULL,
  `agent_number` varchar(20) DEFAULT NULL,
  `interval_json` varchar(255) DEFAULT NULL,
  `callerid` varchar(20) DEFAULT NULL,
  `tts` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10559 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaigns`
--

LOCK TABLES `campaigns` WRITE;
/*!40000 ALTER TABLE `campaigns` DISABLE KEYS */;
INSERT INTO `campaigns` VALUES (10553,'api-201502260951072',NULL,'2015-02-26 09:51:07',2,'apiuser-20150226095107-output1.wav',NULL,10,0,'2015-02-26 14:51:07',0,3,NULL,'{\"network_int\":1,\"userhangup_int\":1,\"userbusy_int\":1,\"ringtimeout_int\":1,\"network_cnt\":\"2\",\"userhangup_cnt\":\"2\",\"userbusy_cnt\":\"2\",\"ringtimeout_cnt\":\"2\"}','',NULL),(10554,'api-201502260953404',2,'2015-02-26 09:53:40',2,'apiuser-20150226095340-output1.wav','csv/10/apiuser-20150226095412-msisdn.csv',10,2,'2015-02-26 14:53:40',0,3,NULL,'{\"network_int\":1,\"userhangup_int\":1,\"userbusy_int\":1,\"ringtimeout_int\":1,\"network_cnt\":\"2\",\"userhangup_cnt\":\"2\",\"userbusy_cnt\":\"2\",\"ringtimeout_cnt\":\"2\"}','','0'),(10555,'api-201502261004554',NULL,'2015-02-26 10:04:55',2,'apiuser-20150226100455-end.mp3',NULL,10,0,'2015-02-26 15:04:55',0,3,NULL,'{\"network_int\":1,\"userhangup_int\":1,\"userbusy_int\":1,\"ringtimeout_int\":1,\"network_cnt\":\"2\",\"userhangup_cnt\":\"2\",\"userbusy_cnt\":\"2\",\"ringtimeout_cnt\":\"2\"}','',NULL),(10556,'api-201502261006114',2,'2015-02-26 10:06:11',2,'apiuser-20150226100611-test.mp3','csv/10/apiuser-20150226100625-msisdn.csv',10,2,'2015-02-26 15:06:11',0,3,NULL,'{\"network_int\":1,\"userhangup_int\":1,\"userbusy_int\":1,\"ringtimeout_int\":1,\"network_cnt\":\"2\",\"userhangup_cnt\":\"2\",\"userbusy_cnt\":\"2\",\"ringtimeout_cnt\":\"2\"}','','0'),(10557,'testmycamo',2,'2015-04-16 07:50:13',0,'1429188613-6984.wav','csv/11/1429188613-6727.csv',11,0,'2015-04-16 12:50:13',0,NULL,NULL,NULL,NULL,NULL),(10558,'SamsungOffer',1,'2015-04-16 07:59:37',0,'','csv/11/1429189177-4375.csv',11,0,'2015-04-16 12:59:37',0,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `campaigns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checkers_log`
--

DROP TABLE IF EXISTS `checkers_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `checkers_log` (
  `chid` int(11) NOT NULL AUTO_INCREMENT,
  `checkerid` int(11) DEFAULT NULL,
  `campid` int(11) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `keypress` varchar(16) DEFAULT NULL,
  `audio_clips` varchar(128) DEFAULT NULL,
  `templateid` int(10) DEFAULT NULL,
  `msisdn` bigint(11) DEFAULT NULL,
  `dtmf` varchar(16) DEFAULT NULL,
  `makerid` int(11) DEFAULT NULL,
  `retrycount` int(11) DEFAULT NULL,
  `userid` bigint(11) DEFAULT NULL,
  `auth_status` varchar(64) DEFAULT NULL,
  `sch_time` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `retry` smallint(2) DEFAULT NULL,
  `buffer_status` smallint(2) DEFAULT NULL,
  `process_update_status` smallint(6) DEFAULT '0',
  PRIMARY KEY (`chid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checkers_log`
--

LOCK TABLES `checkers_log` WRITE;
/*!40000 ALTER TABLE `checkers_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkers_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_access` varchar(32) DEFAULT NULL,
  `channels` int(11) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `table` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration`
--

LOCK TABLES `configuration` WRITE;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` VALUES (1,'SPAN1',100,'LIVE','trans_node_1'),(2,'SPAN2',100,'LIVE','trans_node_2');
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `did_master`
--

DROP TABLE IF EXISTS `did_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `did_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pri_id` bigint(20) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `isActive` smallint(6) DEFAULT NULL,
  `isAssigned` smallint(6) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `number_prefix` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `did_master`
--

LOCK TABLES `did_master` WRITE;
/*!40000 ALTER TABLE `did_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `did_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(64) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` smallint(255) DEFAULT NULL,
  `grouptype` varchar(32) DEFAULT NULL,
  `count` varchar(255) DEFAULT NULL,
  `user_id` bigint(11) DEFAULT NULL,
  `groupdescription` varchar(255) DEFAULT NULL,
  `csv_file_path` varchar(255) DEFAULT NULL,
  `isActive` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (26,'sivagroup','2015-02-11 13:33:30',NULL,NULL,'1','2',1,'test siva group','csv/1/1423661610-8059.csv',0),(27,'test group','2015-02-11 13:53:22',NULL,NULL,'1','2',1,'description test','csv/1/1423662802-1695.csv',1),(28,'misdin.csv','2015-02-11 13:54:24',NULL,NULL,'0','0',1,'','csv/1/1423662864-5854.csv',1),(29,'misdin.csv','2015-02-11 13:56:42',NULL,NULL,'0','0',1,'','csv/1/1423663002-7702.csv',1),(30,'misdin.csv','2015-02-11 14:00:42',NULL,NULL,'0','0',1,'','csv/1/1423663242-5159.csv',1),(31,'misdin.csv','2015-02-11 14:10:21',NULL,NULL,'0','0',1,'','csv/1/1423663821-7554.csv',1),(32,'misdin.csv','2015-02-11 14:11:47',NULL,NULL,'0','0',1,'','csv/1/1423663907-1557.csv',1),(33,'misdin.csv','2015-02-11 14:12:53',NULL,NULL,'0','0',1,'','csv/1/1423663973-7481.csv',1),(34,'misdin.csv','2015-02-11 14:13:23',NULL,NULL,'0','0',1,'','csv/1/1423664003-7781.csv',1),(35,'misdin.csv','2015-02-11 14:14:08',NULL,NULL,'0','0',1,'','csv/1/1423664048-2748.csv',1),(36,'misdin.csv','2015-02-11 14:16:22',NULL,NULL,'0','0',1,'','csv/1/1423664182-9623.csv',1),(37,'misdin.csv','2015-02-11 14:16:51',NULL,NULL,'0','3',1,'','csv/1/1423664211-9718.csv',1),(38,'misdin.csv','2015-02-11 14:18:07',NULL,NULL,'0','3',1,'','csv/1/1423664287-7703.csv',1),(39,'misdin.csv','2015-02-11 14:30:17',NULL,NULL,'0','3',1,'','csv/1/1423665017-4802.csv',1),(40,'misdin.csv','2015-02-11 15:26:27',NULL,NULL,'0','3',1,'','csv/1/1423668387-5960.csv',1),(41,'msisdn.csv','2015-02-12 09:57:34',NULL,NULL,'0','2',8,'','csv/8/1423735054-4856.csv',1),(42,'msisdn.csv','2015-02-12 10:06:18',NULL,NULL,'0','2',8,'','csv/8/1423735578-1899.csv',1),(43,'msisdn.csv','2015-02-12 10:13:18',NULL,NULL,'0','2',8,'','csv/8/1423735998-8600.csv',1),(44,'msisdn.csv','2015-02-12 10:22:14',NULL,NULL,'0','2',8,'','csv/8/1423736534-7787.csv',1),(45,'msisdn.csv','2015-02-12 10:23:05',NULL,NULL,'0','2',8,'','csv/8/1423736585-7671.csv',1),(46,'msisdn.csv','2015-02-12 10:24:22',NULL,NULL,'0','2',8,'','csv/8/1423736662-4268.csv',1),(47,'msisdn.csv','2015-02-12 10:27:47',NULL,NULL,'0','2',8,'','csv/8/1423736867-2747.csv',1),(48,'msisdn.csv','2015-02-12 13:08:10',NULL,NULL,'0','3',8,'','csv/8/1423746490-9135.csv',1),(49,'msisdn.csv','2015-02-12 13:18:55',NULL,NULL,'0','1',8,'','csv/8/1423747135-3788.csv',1),(50,'misdin.csv','2015-02-12 13:40:35',NULL,NULL,'0','3',8,'','csv/8/1423748435-9339.csv',1),(51,'msisdn.csv','2015-02-12 13:41:38',NULL,NULL,'0','2',8,'','csv/8/1423748498-6236.csv',1),(52,'msisdn.csv','2015-02-12 13:43:03',NULL,NULL,'0','2',8,'','csv/8/1423748583-7960.csv',1),(53,'msisdn.csv','2015-02-12 13:44:58',NULL,NULL,'0','2',8,'','csv/8/1423748698-9611.csv',1),(54,'msisdn.csv','2015-02-12 13:45:30',NULL,NULL,'0','2',8,'','csv/8/1423748730-3319.csv',1),(55,'msisdn.csv','2015-02-12 13:48:06',NULL,NULL,'0','2',8,'','csv/8/1423748886-7383.csv',1),(56,'msisdn.csv','2015-02-13 06:27:54',NULL,NULL,'0','1',8,'','csv/8/1423808874-8983.csv',1),(57,'msisdn.csv','2015-02-13 06:56:49',NULL,NULL,'0','1',8,'','csv/8/1423810609-5548.csv',1),(58,'msisdn.csv','2015-02-13 06:58:21',NULL,NULL,'0','1',8,'','csv/8/1423810701-6774.csv',1),(59,'msisdn.csv','2015-02-13 07:18:57',NULL,NULL,'0','1',8,'','csv/8/1423811937-2109.csv',1),(60,'msisdn.csv','2015-02-13 07:22:00',NULL,NULL,'0','1',8,'','csv/8/1423812120-7599.csv',1),(61,'msisdn.csv','2015-02-13 07:29:27',NULL,NULL,'0','1',8,'','csv/8/1423812567-7565.csv',1),(62,'msisdn.csv','2015-02-13 07:31:22',NULL,NULL,'0','1',8,'','csv/8/1423812682-5473.csv',1),(63,'msisdn.csv','2015-02-13 07:36:57',NULL,NULL,'0','2',8,'','csv/8/1423813017-4299.csv',1),(64,'msisdn.csv','2015-02-13 07:38:29',NULL,NULL,'0','2',8,'','csv/8/1423813109-4924.csv',1),(65,'msisdn.csv','2015-02-13 07:45:31',NULL,NULL,'0','1',8,'','csv/8/1423813531-7575.csv',1),(66,'msisdn.csv','2015-02-13 07:47:47',NULL,NULL,'0','1',8,'','csv/8/1423813666-1487.csv',1),(67,'msisdn.csv','2015-02-13 10:43:54',NULL,NULL,'0','1',8,'','csv/8/1423824234-5108.csv',1),(68,'msisdn.csv','2015-02-26 12:08:33',NULL,NULL,'0','2',8,'','csv/8/1424952513-3915.csv',1),(69,'msisdn.csv','2015-02-26 12:10:36',NULL,NULL,'0','2',8,'','csv/8/1424952636-2364.csv',1),(70,'msisdn.csv','2015-02-26 12:20:45',NULL,NULL,'0','2',8,'','csv/8/1424953245-7225.csv',1),(71,'msisdn.csv','2015-02-26 12:36:42',NULL,NULL,'0','2',8,'','csv/8/1424954202-5822.csv',1),(72,'msisdn.csv','2015-02-26 12:38:50',NULL,NULL,'0','2',8,'','csv/8/1424954330-4609.csv',1),(73,'msisdn.csv','2015-04-16 12:50:13',NULL,NULL,'0','2',11,'','csv/11/1429188613-6727.csv',1),(74,'Test.csv','2015-04-16 12:59:37',NULL,NULL,'0','1',11,'','csv/11/1429189177-4375.csv',1);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ibd_campaigns`
--

DROP TABLE IF EXISTS `ibd_campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ibd_campaigns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `camp_name` varchar(64) DEFAULT NULL,
  `pri_number` varchar(20) DEFAULT NULL,
  `did_number` varchar(20) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `action_api` varchar(128) DEFAULT NULL,
  `template_id` smallint(6) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `isActive` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ibd_campaigns`
--

LOCK TABLES `ibd_campaigns` WRITE;
/*!40000 ALTER TABLE `ibd_campaigns` DISABLE KEYS */;
/*!40000 ALTER TABLE `ibd_campaigns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ibd_mis`
--

DROP TABLE IF EXISTS `ibd_mis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ibd_mis` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `calling_number` varchar(20) DEFAULT NULL,
  `called_number` varchar(20) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `template` varchar(64) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `api` varchar(255) DEFAULT NULL,
  `camp_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ibd_mis`
--

LOCK TABLES `ibd_mis` WRITE;
/*!40000 ALTER TABLE `ibd_mis` DISABLE KEYS */;
/*!40000 ALTER TABLE `ibd_mis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language`
--

LOCK TABLES `language` WRITE;
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
/*!40000 ALTER TABLE `language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `latency`
--

DROP TABLE IF EXISTS `latency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `latency` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Total_calls` bigint(20) DEFAULT NULL,
  `Latency15` bigint(20) DEFAULT NULL,
  `Latency1630` bigint(20) DEFAULT NULL,
  `Latency3160` bigint(20) DEFAULT NULL,
  `Latency61120` bigint(20) DEFAULT NULL,
  `Latency121180` bigint(20) DEFAULT NULL,
  `Latency181300` bigint(20) DEFAULT NULL,
  `LatencyGreaterthan300` bigint(20) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `calling_hour` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `latency`
--

LOCK TABLES `latency` WRITE;
/*!40000 ALTER TABLE `latency` DISABLE KEYS */;
/*!40000 ALTER TABLE `latency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obd_mis`
--

DROP TABLE IF EXISTS `obd_mis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obd_mis` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `called_number` varchar(20) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `obdrecord_id` bigint(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `call_starttime` datetime DEFAULT NULL,
  `call_endtime` datetime DEFAULT NULL,
  `call_duration` int(11) DEFAULT NULL,
  `user_keypress` varchar(64) DEFAULT NULL,
  `dial_status` varchar(64) DEFAULT NULL,
  `retry_count` int(11) DEFAULT NULL,
  `last_clip` varchar(128) DEFAULT NULL,
  `ischecker` smallint(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `chk_auth_status` varchar(64) DEFAULT NULL,
  `agent_number` varchar(20) DEFAULT NULL,
  `bridge_status` varchar(64) DEFAULT NULL,
  `bridge_duration` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=358002 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obd_mis`
--

LOCK TABLES `obd_mis` WRITE;
/*!40000 ALTER TABLE `obd_mis` DISABLE KEYS */;
INSERT INTO `obd_mis` VALUES (357995,'9791718441',10554,114655,10,3,'2015-02-26 14:54:14','2015-02-26 14:54:19','2015-02-26 14:54:21',2,'','Success',0,'VC-1',0,1,'',NULL,NULL,NULL),(357996,'9790053340',10554,114654,10,3,'2015-02-26 14:54:14','2015-02-26 14:54:20','2015-02-26 14:54:37',17,'','Success',0,'VC-1',0,1,'',NULL,NULL,NULL),(357997,'9791718441',10556,114657,10,3,'2015-02-26 15:06:28','2015-02-26 15:06:31','2015-02-26 15:06:35',4,'','Success',0,'VC-1',0,1,'',NULL,NULL,NULL),(357998,'9790053340',10556,114656,10,3,'2015-02-26 15:06:28','2015-02-26 15:06:35','2015-02-26 15:06:48',13,'','Success',0,'VC-1',0,1,'',NULL,NULL,NULL),(357999,'9790053340',10556,114658,10,3,'2015-02-26 15:10:49','2015-02-26 15:11:05','2015-02-26 15:11:29',24,'','Success',0,'VC-1',0,1,'',NULL,NULL,NULL),(358000,'9790053340',10557,114659,11,3,'2015-04-16 12:50:13','2015-04-16 12:50:14','2015-04-16 12:50:14',0,'','Network error',0,'',0,1,'',NULL,NULL,NULL),(358001,'1234567890',10557,114660,11,3,'2015-04-16 12:50:14','2015-04-16 12:50:14','2015-04-16 12:50:14',0,'','Network error',0,'',0,1,'',NULL,NULL,NULL);
/*!40000 ALTER TABLE `obd_mis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_node_1`
--

DROP TABLE IF EXISTS `promo_node_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_node_1` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `no2dial` varchar(20) DEFAULT NULL,
  `campaign_id` bigint(20) DEFAULT NULL,
  `template_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `obdrecord_id` bigint(20) DEFAULT NULL,
  `clips` varchar(1064) DEFAULT NULL,
  `max_duration` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `buffer_status` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `retry` int(11) DEFAULT NULL,
  `retry_count` int(11) DEFAULT '0',
  `isChecker` smallint(6) DEFAULT NULL COMMENT '0-Normal;1-Checker',
  `tts` text,
  `agent_number` varchar(20) DEFAULT NULL,
  `interval_json` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_node_1`
--

LOCK TABLES `promo_node_1` WRITE;
/*!40000 ALTER TABLE `promo_node_1` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_node_1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_retry`
--

DROP TABLE IF EXISTS `promo_retry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_retry` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `no2dial` varchar(20) DEFAULT NULL,
  `campaign_id` bigint(20) DEFAULT NULL,
  `template_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `obdrecord_id` bigint(20) DEFAULT NULL,
  `clips` varchar(1064) DEFAULT NULL,
  `max_duration` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `buffer_status` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `retry` int(11) DEFAULT NULL,
  `retry_count` int(11) DEFAULT '0',
  `isChecker` smallint(6) DEFAULT NULL COMMENT '0-Normal;1-Checker',
  `tts` text,
  `agent_number` varchar(20) DEFAULT NULL,
  `interval_json` varchar(255) DEFAULT NULL,
  `dial_status` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_retry`
--

LOCK TABLES `promo_retry` WRITE;
/*!40000 ALTER TABLE `promo_retry` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_retry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regd_users`
--

DROP TABLE IF EXISTS `regd_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regd_users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `isActive` smallint(6) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regd_users`
--

LOCK TABLES `regd_users` WRITE;
/*!40000 ALTER TABLE `regd_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `regd_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roletype`
--

DROP TABLE IF EXISTS `roletype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roletype` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(16) NOT NULL,
  `createddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roletype`
--

LOCK TABLES `roletype` WRITE;
/*!40000 ALTER TABLE `roletype` DISABLE KEYS */;
INSERT INTO `roletype` VALUES (1,'superadmin','2014-05-20 20:29:33','0000-00-00 00:00:00'),(2,'admin','2014-05-20 20:29:35','0000-00-00 00:00:00'),(3,'maker','2014-05-20 20:29:37','0000-00-00 00:00:00'),(4,'checker','2014-05-20 20:29:40','0000-00-00 00:00:00'),(5,'user','2014-05-20 20:29:46','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `roletype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stop_camp_log`
--

DROP TABLE IF EXISTS `stop_camp_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stop_camp_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `campaign_id` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `total_stopped` bigint(20) DEFAULT NULL,
  `requested` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stop_camp_log`
--

LOCK TABLES `stop_camp_log` WRITE;
/*!40000 ALTER TABLE `stop_camp_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `stop_camp_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stop_camp_queue`
--

DROP TABLE IF EXISTS `stop_camp_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stop_camp_queue` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stop_camp_queue`
--

LOCK TABLES `stop_camp_queue` WRITE;
/*!40000 ALTER TABLE `stop_camp_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `stop_camp_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribers` (
  `subid` bigint(11) NOT NULL AUTO_INCREMENT,
  `msisdn` varchar(20) DEFAULT NULL,
  `campid` bigint(11) DEFAULT NULL,
  `audio_clip` varchar(1024) DEFAULT NULL,
  `isbuffer` smallint(2) DEFAULT NULL,
  `retry` smallint(2) DEFAULT NULL,
  `sch_time` datetime DEFAULT NULL,
  `status` smallint(2) DEFAULT '0',
  `template_id` int(11) DEFAULT NULL,
  `user_acc_type` enum('Promo','transaction','ftp','http') DEFAULT NULL,
  `process_state` smallint(2) DEFAULT NULL COMMENT '1-user;2-maker;3-picked;4-dialed',
  `user_id` bigint(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `tts` text,
  `agent_number` varchar(20) DEFAULT NULL,
  `interval_json` varchar(255) DEFAULT NULL,
  `callerid` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`subid`)
) ENGINE=InnoDB AUTO_INCREMENT=114662 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
INSERT INTO `subscribers` VALUES (114654,'9790053340',10554,'apiuser-20150226095340-output1.wav',0,2,'2015-02-26 09:53:40',0,3,NULL,6,10,'2015-02-26 14:54:13','0',NULL,'{\"network_int\":1,\"userhangup_int\":1,\"userbusy_int\":1,\"ringtimeout_int\":1,\"network_cnt\":\"2\",\"userhangup_cnt\":\"2\",\"userbusy_cnt\":\"2\",\"ringtimeout_cnt\":\"2\"}',''),(114655,'9791718441',10554,'apiuser-20150226095340-output1.wav',0,2,'2015-02-26 09:53:40',0,3,NULL,6,10,'2015-02-26 14:54:13','0',NULL,'{\"network_int\":1,\"userhangup_int\":1,\"userbusy_int\":1,\"ringtimeout_int\":1,\"network_cnt\":\"2\",\"userhangup_cnt\":\"2\",\"userbusy_cnt\":\"2\",\"ringtimeout_cnt\":\"2\"}',''),(114656,'9790053340',10556,'apiuser-20150226100611-test.mp3',0,2,'2015-02-26 10:06:11',0,3,NULL,6,10,'2015-02-26 15:06:27','0',NULL,'{\"network_int\":1,\"userhangup_int\":1,\"userbusy_int\":1,\"ringtimeout_int\":1,\"network_cnt\":\"2\",\"userhangup_cnt\":\"2\",\"userbusy_cnt\":\"2\",\"ringtimeout_cnt\":\"2\"}',''),(114657,'9791718441',10556,'apiuser-20150226100611-test.mp3',0,2,'2015-02-26 10:06:11',0,3,NULL,6,10,'2015-02-26 15:06:27','0',NULL,'{\"network_int\":1,\"userhangup_int\":1,\"userbusy_int\":1,\"ringtimeout_int\":1,\"network_cnt\":\"2\",\"userhangup_cnt\":\"2\",\"userbusy_cnt\":\"2\",\"ringtimeout_cnt\":\"2\"}',''),(114658,'9790053340',10556,'apiuser-20150226100611-test.wav',NULL,2,'0000-00-00 00:00:00',0,3,NULL,6,10,NULL,'0',NULL,NULL,NULL),(114659,'9790053340',10557,'1429188613-6984.wav',0,0,'2015-04-16 07:50:13',0,3,NULL,6,11,'2015-04-16 12:50:13',NULL,NULL,NULL,NULL),(114660,'1234567890',10557,'1429188613-6984.wav',0,0,'2015-04-16 07:50:13',0,3,NULL,6,11,'2015-04-16 12:50:13',NULL,NULL,NULL,NULL),(114661,'9948669920',10558,'',0,0,'2015-04-16 07:59:37',0,3,NULL,5,11,'2015-04-16 12:59:37',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `summary`
--

DROP TABLE IF EXISTS `summary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` int(11) DEFAULT NULL,
  `success` int(11) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `percent` float DEFAULT NULL,
  `call_date` date DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `less15` int(11) DEFAULT NULL,
  `more15` int(11) DEFAULT NULL,
  `dropped` int(11) DEFAULT NULL,
  `failed` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `summary`
--

LOCK TABLES `summary` WRITE;
/*!40000 ALTER TABLE `summary` DISABLE KEYS */;
/*!40000 ALTER TABLE `summary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_session`
--

DROP TABLE IF EXISTS `tbl_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) DEFAULT NULL,
  `ts` datetime DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_session`
--

LOCK TABLES `tbl_session` WRITE;
/*!40000 ALTER TABLE `tbl_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `templates`
--

DROP TABLE IF EXISTS `templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `clip_count` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `jpeg_path` varchar(255) DEFAULT NULL,
  `csv_format` varchar(255) DEFAULT 'msisdn',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `templates`
--

LOCK TABLES `templates` WRITE;
/*!40000 ALTER TABLE `templates` DISABLE KEYS */;
INSERT INTO `templates` VALUES (3,'OneClip_Campaign',1,'2014-04-01 11:01:26',1,'templates/1/OneClip_IVR.png','msisdn'),(4,'OneOption_Campaign',3,'2014-05-08 20:50:41',1,'templates/2/OneClip_OneOption.png','msisdn'),(5,'TwoOptions_Campaign',4,'2014-05-08 20:50:45',1,'templates/3/OneClip_TwoOptions.png','msisdn'),(6,'FourOptions_Campaign',6,'2014-05-08 20:50:47',1,'templates/4/OneClip_FourOptions.png','msisdn'),(7,'FiveOptions_Campaign',3,'2014-05-08 20:50:48',1,'templates/5/OneClip_FiveOptions.png','msisdn'),(8,'Double_Confirmation',4,'2014-05-08 20:50:50',1,'templates/6/Subscribe_Confirm.png','msisdn'),(9,'SingleClip_TTS',1,'2014-06-09 16:06:28',0,NULL,'msisdn'),(10,'OneClip_Keypress',1,'2014-07-08 17:48:00',0,NULL,'msisdn'),(11,'Click2Connect',1,'2014-07-14 13:04:35',0,NULL,'msisdn'),(12,'HDFC Template',1,'2014-07-25 11:58:00',0,NULL,'msisdn'),(13,'TwoClips_TTS_DATE',2,'2014-08-08 20:07:05',0,NULL,'msisdn'),(14,'TTS_AMOUNT_DATE',9,'2014-08-20 11:48:35',0,NULL,'msisdn'),(15,'AMD_Basic',6,'2014-08-20 15:43:41',0,NULL,'msisdn');
/*!40000 ALTER TABLE `templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_node_1`
--

DROP TABLE IF EXISTS `trans_node_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_node_1` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `no2dial` varchar(20) DEFAULT NULL,
  `campaign_id` bigint(20) DEFAULT NULL,
  `template_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `obdrecord_id` bigint(20) DEFAULT NULL,
  `clips` varchar(1064) DEFAULT NULL,
  `max_duration` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `buffer_status` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `retry` int(11) DEFAULT NULL,
  `retry_count` int(11) DEFAULT '0',
  `isChecker` smallint(6) DEFAULT NULL,
  `tts` text,
  `agent_number` varchar(20) DEFAULT NULL,
  `interval_json` varchar(255) DEFAULT NULL,
  `callerid` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11660 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_node_1`
--

LOCK TABLES `trans_node_1` WRITE;
/*!40000 ALTER TABLE `trans_node_1` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_node_1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_node_2`
--

DROP TABLE IF EXISTS `trans_node_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_node_2` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `no2dial` varchar(20) DEFAULT NULL,
  `campaign_id` bigint(20) DEFAULT NULL,
  `template_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `obdrecord_id` bigint(20) DEFAULT NULL,
  `clips` varchar(1064) DEFAULT NULL,
  `max_duration` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `buffer_status` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `retry` int(11) DEFAULT NULL,
  `retry_count` int(11) DEFAULT '0',
  `isChecker` smallint(6) DEFAULT NULL,
  `tts` text,
  `agent_number` varchar(20) DEFAULT NULL,
  `interval_json` varchar(255) DEFAULT NULL,
  `callerid` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10637 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_node_2`
--

LOCK TABLES `trans_node_2` WRITE;
/*!40000 ALTER TABLE `trans_node_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_node_2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_retry_1`
--

DROP TABLE IF EXISTS `trans_retry_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_retry_1` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `no2dial` varchar(20) DEFAULT NULL,
  `campaign_id` bigint(20) DEFAULT NULL,
  `template_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `obdrecord_id` bigint(20) DEFAULT NULL,
  `clips` varchar(1064) DEFAULT NULL,
  `max_duration` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `buffer_status` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `retry` int(11) DEFAULT NULL,
  `retry_count` int(11) DEFAULT '0',
  `isChecker` smallint(6) DEFAULT NULL,
  `tts` text,
  `agent_number` varchar(20) DEFAULT NULL,
  `interval_json` varchar(255) DEFAULT NULL,
  `dial_status` varchar(64) DEFAULT NULL,
  `callerid` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_retry_1`
--

LOCK TABLES `trans_retry_1` WRITE;
/*!40000 ALTER TABLE `trans_retry_1` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_retry_1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_retry_2`
--

DROP TABLE IF EXISTS `trans_retry_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_retry_2` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `no2dial` varchar(20) DEFAULT NULL,
  `campaign_id` bigint(20) DEFAULT NULL,
  `template_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `obdrecord_id` bigint(20) DEFAULT NULL,
  `clips` varchar(1064) DEFAULT NULL,
  `max_duration` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `buffer_status` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `retry` int(11) DEFAULT NULL,
  `retry_count` int(11) DEFAULT '0',
  `isChecker` smallint(6) DEFAULT NULL,
  `tts` text,
  `agent_number` varchar(20) DEFAULT NULL,
  `interval_json` varchar(255) DEFAULT NULL,
  `dial_status` varchar(64) DEFAULT NULL,
  `callerid` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_retry_2`
--

LOCK TABLES `trans_retry_2` WRITE;
/*!40000 ALTER TABLE `trans_retry_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_retry_2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userid` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `masterid` int(11) NOT NULL,
  `rolename` smallint(6) DEFAULT NULL COMMENT '1-superadmin;2-admin;3-maker;4-checker;5-user',
  `acc_type` varchar(16) NOT NULL COMMENT 'Prepaid/Postpaid',
  `channel` varchar(64) NOT NULL COMMENT 'GUI,HTTP',
  `created` datetime NOT NULL,
  `email` varchar(32) NOT NULL,
  `expireddate` datetime NOT NULL,
  `mobile` varchar(32) NOT NULL,
  `modifiedby` varchar(16) NOT NULL,
  `status` int(10) NOT NULL,
  `usertype` smallint(2) NOT NULL COMMENT 'promo/trans',
  `account_manager_email` varchar(32) NOT NULL,
  `account_manager_number` bigint(11) NOT NULL,
  `assign_did` varchar(128) NOT NULL,
  `assign_services` varchar(128) NOT NULL,
  `assign_templates` varchar(128) NOT NULL,
  `credits` bigint(11) NOT NULL,
  `fax` bigint(11) NOT NULL,
  `isActive` smallint(2) NOT NULL,
  `organisation` varchar(32) NOT NULL,
  `assign_checkers` varchar(16) NOT NULL,
  `user_description` varchar(255) DEFAULT NULL,
  `dialler` smallint(6) DEFAULT NULL COMMENT '0-Default;1-Thirdparty',
  `vendor` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test_user','123456',0,2,'prepaid','GUI+HTTP','2014-05-20 19:54:09','rprasad@mgage.com','0000-00-00 00:00:00','9962977283','',0,1,'',0,'0','0','1',0,0,1,'','',NULL,NULL,NULL),(7,'usapitest','test1234',0,2,'prepaid','GUI+HTTP','2014-05-21 18:37:05','rprasad@mgage.com','0000-00-00 00:00:00','9962977283','',0,1,'',0,'0','0','1',0,0,1,'','',NULL,NULL,NULL),(8,'balaji','123456',1,5,'','GUI','2015-02-12 07:13:09','leebalaji@gmail.com','0000-00-00 00:00:00','9791718441','',0,1,'',0,'','','',0,0,1,'','','',NULL,NULL),(9,'sivacheckers','12345678',1,5,'','GUI','2015-02-17 14:45:51','sivaa@gmail.com','0000-00-00 00:00:00','9790053340','',0,5,'',0,'','','',0,0,1,'','','',NULL,NULL),(10,'apiuser','123456',1,5,'','GUI+HTTP','2015-02-26 07:05:52','apiuser@gmail.com','0000-00-00 00:00:00','9876543211','',0,1,'',0,'','','',0,0,1,'','','',NULL,NULL),(11,'demo','demo',1,5,'','GUI','2015-04-16 12:38:55','demo@demo.com','0000-00-00 00:00:00','1234567890','',0,1,'',0,'','','',0,0,1,'','','',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voice_file_locations`
--

DROP TABLE IF EXISTS `voice_file_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voice_file_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(1024) DEFAULT NULL,
  `campaignid` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `csv_format` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=426 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voice_file_locations`
--

LOCK TABLES `voice_file_locations` WRITE;
/*!40000 ALTER TABLE `voice_file_locations` DISABLE KEYS */;
INSERT INTO `voice_file_locations` VALUES (423,'/tmp/10552/4628/002827_4361694241',10552,1,'2015-02-26 14:40:34','msisdn'),(424,'/tmp/10554/8994/004959_2542694241',10554,1,'2015-02-26 14:54:12','msisdn'),(425,'/tmp/10556/9758/000185_6813694241',10556,1,'2015-02-26 15:06:26','msisdn');
/*!40000 ALTER TABLE `voice_file_locations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-24 13:21:47
