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
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(75) DEFAULT NULL,
  `id_no` varchar(15) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `blood_group` varchar(45) DEFAULT NULL,
  `address_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`,`id_no`),
  KEY `student_address_fk_idx` (`address_id`),
  CONSTRAINT `student_address_fk` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Raju Mesfin','RF-0001','1986-09-09','Male','O+',NULL),(2,'Elias Mesfin','RF-002','1985-01-09','Male','O+',NULL),(3,'Sadam Mesfin','RF-003','1958-09-09','Male','O+',NULL),(4,'Hikmet Abdusemed','RF-004','2018-01-02','Female','A+',NULL),(5,'Raju Mesfin','RF-0005','1986-09-09','Male','O+',NULL),(6,'Elias Mesfin','RF-006','1985-01-09','Male','O+',NULL),(7,'Sadam Mesfin','RF-007','1958-09-09','Male','O+',NULL),(8,'Hikmet Abdusemed','RF-008','2018-01-02','Female','A+',NULL),(9,'Raju Mesfin','RF-0010','1986-09-09','Male','O+',NULL),(10,'Elias Mesfin','RF-0011','1985-01-09','Male','O+',NULL),(11,'Sadam Mesfin','RF-0012','1958-09-09','Male','O+',NULL),(12,'Hikmet Abdusemed','RF-0013','2018-01-02','Female','A+',NULL),(13,'Raju Mesfin','RF-00014','1986-09-09','Male','O+',NULL),(14,'Elias Mesfin','RF-0015','1985-01-09','Male','O+',NULL),(15,'Sadam Mesfin','RF-0016','1958-09-09','Male','O+',NULL),(16,'Hikmet Abdusemed','RF-0017','2018-01-02','Female','A+',NULL);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-02 12:54:29
