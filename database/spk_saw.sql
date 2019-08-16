-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: spk_saw
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
-- Table structure for table `kampus`
--

DROP TABLE IF EXISTS `kampus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kampus` (
  `id_kampus` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kampus` varchar(255) NOT NULL,
  `link` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kampus`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kampus`
--

LOCK TABLES `kampus` WRITE;
/*!40000 ALTER TABLE `kampus` DISABLE KEYS */;
INSERT INTO `kampus` VALUES (9,'universitas brawijaya','ub.ac.id'),(10,'STIKI','stiki.ac.id'),(11,'UNMER','unmer.ac.id'),(22,'universitas negeri malang','um.ac.id'),(23,'bogor','itb.ac.id'),(24,'universitas indonesia','ui.ac.id'),(25,'kampus asia','asia.ac.id'),(26,'machung','machung.ac.id'),(27,'ITN malang','itn.ac.id');
/*!40000 ALTER TABLE `kampus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(255) NOT NULL,
  `jenis` enum('cost','benefit') NOT NULL,
  `bobot` double NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kriteria`
--

LOCK TABLES `kriteria` WRITE;
/*!40000 ALTER TABLE `kriteria` DISABLE KEYS */;
INSERT INTO `kriteria` VALUES (1,'alexa','benefit',0.2),(2,'google_index','benefit',0.2),(3,'umur','benefit',0.1),(4,'backlink','benefit',0.2),(5,'semrush','cost',0.25);
/*!40000 ALTER TABLE `kriteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) DEFAULT NULL,
  `id_kampus` int(11) DEFAULT NULL,
  `nilai` double NOT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `FK_kriteria` (`id_kriteria`),
  KEY `FK_kampus` (`id_kampus`),
  CONSTRAINT `FK_kampus` FOREIGN KEY (`id_kampus`) REFERENCES `kampus` (`id_kampus`),
  CONSTRAINT `FK_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (76,1,9,211),(77,2,9,3400000),(78,3,9,10),(79,4,9,24363),(80,5,9,321523),(81,1,10,5154),(82,2,10,27200),(83,3,10,21),(84,4,10,5857),(85,5,10,4712664),(86,1,11,3094),(87,2,11,23200),(88,3,11,21),(89,4,11,1465),(90,5,11,5450973),(91,1,22,296),(92,2,22,445000),(93,3,22,17),(94,4,22,26052),(95,5,22,595444),(96,1,23,476),(97,2,23,353000),(98,3,23,22),(99,4,23,3198),(100,5,23,393530),(101,1,24,194),(102,2,24,998000),(103,3,24,21),(104,4,24,4887),(105,5,24,203765),(106,1,25,9404),(107,2,25,9860),(108,3,25,14),(109,4,25,1101),(110,5,25,12178259),(111,1,26,16064),(112,2,26,3170),(113,3,26,12),(114,4,26,295),(115,5,26,3424085),(116,1,27,4396),(117,2,27,32000),(118,3,27,19),(119,4,27,1623),(120,5,27,5758038);
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-17 18:03:09
