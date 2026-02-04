-- MySQL dump 10.13  Distrib 8.0.40, for macos14 (arm64)
--
-- Host: localhost    Database: pet_adoption
-- ------------------------------------------------------
-- Server version	9.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adoption_responses`
--

DROP TABLE IF EXISTS `adoption_responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adoption_responses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pet_name` varchar(100) NOT NULL,
  `answer1` text NOT NULL,
  `answer2` text NOT NULL,
  `answer3` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adoption_responses`
--

LOCK TABLES `adoption_responses` WRITE;
/*!40000 ALTER TABLE `adoption_responses` DISABLE KEYS */;
INSERT INTO `adoption_responses` VALUES (1,'Kanzi','i need to have','yes it was pleasent','5-7 hours','2024-12-22 12:52:05'),(2,'richard','kuşcağız mahallesi aşıkveysel caddesi 57/10 keçiören/Ankara','evet. bir köpeğim oldu, iyi ilgilenmiştim onunla.','3-4 saat','2024-12-22 13:17:06'),(3,'cakal','ankara keçiöen kuşcağız','evet güzeldi.','5 saat','2024-12-22 13:20:37'),(4,'sa','baba','hehe','3','2024-12-22 14:04:46'),(5,'Angel','baba','nyeküm','selam','2024-12-22 14:05:17'),(6,'Hyper','ankara keçiören','evet iyiydi deneyimim.','6','2024-12-22 15:32:21'),(7,'Cooper','istanbul, şişli.','evet 2 tane kedim oldu.','1 saat','2024-12-22 15:32:50');
/*!40000 ALTER TABLE `adoption_responses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-22 18:40:52
