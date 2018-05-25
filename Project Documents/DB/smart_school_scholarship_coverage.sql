CREATE DATABASE  IF NOT EXISTS `smart_school` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `smart_school`;
-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: smart_school
-- ------------------------------------------------------
-- Server version	5.7.20

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
-- Table structure for table `scholarship_coverage`
--

DROP TABLE IF EXISTS `scholarship_coverage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scholarship_coverage` (
  `id` int(11) NOT NULL,
  `scholarshiop_code` int(10) unsigned DEFAULT NULL,
  `fee_type_code` int(10) unsigned DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `amount_type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `scholarhiop_coverage_fk_idx` (`scholarshiop_code`),
  KEY `scholarsiop_fee_fk_idx` (`fee_type_code`),
  CONSTRAINT `scholarhiop_coverage_fk` FOREIGN KEY (`scholarshiop_code`) REFERENCES `scholarship_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `scholarsiop_fee_fk` FOREIGN KEY (`fee_type_code`) REFERENCES `fee_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scholarship_coverage`
--

LOCK TABLES `scholarship_coverage` WRITE;
/*!40000 ALTER TABLE `scholarship_coverage` DISABLE KEYS */;
/*!40000 ALTER TABLE `scholarship_coverage` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-02 12:54:30
