CREATE DATABASE  IF NOT EXISTS `shashki` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `shashki`;
-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: shashki
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gamer_1` int(11) NOT NULL,
  `gamer_2` int(11) NOT NULL,
  PRIMARY KEY (`id`,`gamer_1`,`gamer_2`),
  KEY `fk_games_users_idx` (`gamer_1`),
  KEY `fk_games_users1_idx` (`gamer_2`),
  CONSTRAINT `fk_games_users` FOREIGN KEY (`gamer_1`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_games_users1` FOREIGN KEY (`gamer_2`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (1,17,18),(2,17,18),(3,17,18),(4,17,18),(5,17,18),(6,17,18),(7,17,18),(16,17,18);
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `letter` varchar(1) DEFAULT NULL,
  `number` int(2) DEFAULT NULL,
  `games_id` int(11) NOT NULL,
  `gamer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`games_id`,`gamer_id`),
  KEY `fk_states_games1_idx` (`games_id`),
  KEY `fk_states_users1_idx` (`gamer_id`),
  CONSTRAINT `fk_states_games1` FOREIGN KEY (`games_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_states_users1` FOREIGN KEY (`gamer_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=401 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (361,'a',1,16,17),(362,'a',3,16,17),(363,'b',2,16,17),(364,'b',4,16,17),(365,'c',1,16,17),(366,'c',3,16,17),(367,'d',2,16,17),(368,'d',4,16,17),(369,'e',1,16,17),(370,'e',3,16,17),(371,'f',2,16,17),(372,'f',4,16,17),(373,'g',1,16,17),(374,'g',3,16,17),(375,'h',2,16,17),(376,'h',4,16,17),(377,'i',1,16,17),(378,'i',3,16,17),(379,'j',2,16,17),(380,'j',4,16,17),(381,'a',7,16,18),(382,'a',9,16,18),(383,'b',8,16,18),(384,'b',10,16,18),(385,'c',7,16,18),(386,'c',9,16,18),(387,'d',8,16,18),(388,'d',10,16,18),(389,'e',7,16,18),(390,'e',9,16,18),(391,'f',8,16,18),(392,'f',10,16,18),(393,'g',7,16,18),(394,'g',9,16,18),(395,'h',8,16,18),(396,'h',10,16,18),(397,'i',7,16,18),(398,'i',9,16,18),(399,'j',8,16,18),(400,'j',10,16,18);
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (17,'user1','u@u.ru'),(18,'user2','u@d.ru');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-25 16:24:17
