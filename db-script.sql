-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: issue_tracker
-- ------------------------------------------------------
-- Server version	5.6.23-log

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(200) NOT NULL,
  `submit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_users_fk_idx` (`author_id`),
  KEY `comments_issues_fk_idx` (`issue_id`),
  CONSTRAINT `comments_users_fk` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'Test comment','2015-06-26 03:04:37',2,1),(2,'Test comment','2015-06-26 03:04:37',2,1),(3,'I am Stamat','2015-06-26 03:04:52',5,1),(18,'','2015-06-26 04:43:19',1,7),(19,'','2015-06-26 04:44:51',1,7),(20,'','2015-06-26 04:46:28',1,7),(21,'','2015-06-26 04:58:51',1,7),(22,'Nov komentar','2015-06-26 04:59:37',1,7),(23,'','2015-06-26 06:22:59',1,7),(24,'','2015-06-26 06:24:14',1,7);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `submit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `issues_users_fk_idx` (`author_id`),
  KEY `issues_states_fk_idx` (`state_id`),
  CONSTRAINT `issues_states_fk` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `issues_users_fk` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issues`
--

LOCK TABLES `issues` WRITE;
/*!40000 ALTER TABLE `issues` DISABLE KEYS */;
INSERT INTO `issues` VALUES (1,'This is opened issue','This is opened issue\r\nsome loooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooong text','2015-06-25 17:35:10',1,2),(2,'Cannot acces http://www.google.com','Cannot acces http://www.google.com','2015-06-25 17:35:10',1,2),(3,'Cannot acces http://www.google.com','Cannot acces http://www.google.com','2015-06-25 17:35:10',1,1),(4,'Cannot acces http://www.google.com','Cannot acces http://www.google.com','2015-06-25 17:35:10',1,1),(5,'Cannot acces http://www.google.com','Cannot acces http://www.google.com','2015-06-25 17:35:10',1,1),(6,'Cannot acces http://www.google.com','Cannot acces http://www.google.com','2015-06-25 17:35:10',1,3),(7,'Cannot acces http://www.google.com','Cannot acces http://www.google.com','2015-06-25 17:35:10',1,1),(8,'Cannot acces http://www.google.com','Cannot acces http://www.google.com','2015-06-25 17:35:10',1,4),(9,'Cannot acces http://www.google.com','Cannot acces http://www.google.com','2015-06-25 17:35:10',1,1),(10,'Test','Cannot acces http://www.google.com','2015-06-25 17:35:10',1,1),(11,'Cannot acces http://www.google.com','Cannot acces http://www.google.com','2015-06-25 17:35:10',1,1);
/*!40000 ALTER TABLE `issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_type` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'New'),(2,'Open'),(3,'Fixed'),(4,'Closed');
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
  `username` varchar(45) NOT NULL,
  `password_hash` varchar(60) DEFAULT NULL,
  `is_admin` bit(1) DEFAULT b'0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usernam_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ivan','$2y$10$SSyqBD1cbZ/U4cshkfBlyucjjzHX2Q2z2Bsrlee/oIrQd1Gs/7K3S','\0'),(2,'Pesho','$2y$10$GH6KxNABYRSdfSnddlElBOUd5PJg8uvJWt7FWP0QJYDMi5/YyYuza','\0'),(3,'ivan5','$2y$10$1KGjgnhpV4PePgPFLpS8Ru1RGlB89fjUBSH.Zo/uGvYwac9zLilIO','\0'),(4,'Ivan213','$2y$10$b1XRRK9JweRw3jL2BA3w8OpO.YxxoGWtoEbYk8IsdS/BVQ98M0Rr.','\0'),(5,'stamat','$2y$10$wELsuSk7bj4iox0ncNxtw.S9VQaYSRgHVxauGgyyJQVBBmGgP3DhW','\0'),(6,'ivan2241','$2y$10$9DaDYmvfSQkh6zgAu9WUbe3DQpfHpKdHWqu78qOvmLrKu6OqNkveu','\0'),(7,'ivan00','$2y$10$QRBNjr4MMCNbLStqkS/zgOud7F2navIC96QMI7l4c5.2LBSg7DW6e','\0'),(8,'Minka','$2y$10$VtcsBmNrK8U7ZYnfJiCfqubKBC8KllkckxoiAxFEox41xsLKkXz6i','\0');
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

-- Dump completed on 2015-06-26  6:39:28
