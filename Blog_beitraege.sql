CREATE DATABASE  IF NOT EXISTS `Blog` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `Blog`;
-- MySQL dump 10.13  Distrib 5.5.54, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: Blog
-- ------------------------------------------------------
-- Server version	5.5.54-0ubuntu0.14.04.1

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
-- Table structure for table `beitraege`
--

DROP TABLE IF EXISTS `beitraege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beitraege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(1000) DEFAULT NULL,
  `zeit` timestamp NULL DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beitraege`
--

LOCK TABLES `beitraege` WRITE;
/*!40000 ALTER TABLE `beitraege` DISABLE KEYS */;
INSERT INTO `beitraege` VALUES (1,'text und bild','2017-02-09 13:30:12',0),(2,'test','2017-02-21 09:10:10',0),(3,'beitrag1','2017-02-21 13:09:43',0),(4,'ich bin ein Beitrag vom Januar','2017-01-11 10:18:49',0),(83,'<p>Some Art - Beautiful bike</p>','2017-02-21 14:43:48',0),(84,'<p>text ohne bild</p>','2017-02-22 05:42:28',0),(85,'<p>text beispiel</p>','2017-02-22 13:47:09',0),(93,'<h1 style=\"text-align: center;\">Training 19.02.2017</h1>\n<p><span style=\"font-family: comic sans ms,sans-serif; font-size: 12pt;\">Am Sonntag hatten wir wieder Training und haben auch viel geschafft. Wir versuchen weiter das Programm zu festigen, damit wir uns zur Landesmeisterschaft f&uuml;r den <span style=\"color: #ff0000;\">Deutschland Pokal</span> qualifizieren. </span></p>','2017-02-23 13:10:37',0),(119,'<p>abc</p>','2017-02-27 12:07:14',3),(120,'','2017-03-01 06:19:37',1),(121,'<p>70 Jahre ESV Lok Zwickau am 11.03.2017 im Ballhaus \"Neue Welt\".</p>','2017-03-14 12:20:42',4),(122,'','2017-04-04 11:33:38',0),(123,'','2017-04-04 12:37:16',0);
/*!40000 ALTER TABLE `beitraege` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-05 15:20:21
