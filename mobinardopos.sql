-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: mobinardopos
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_payment_settings`
--

DROP TABLE IF EXISTS `admin_payment_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_payment_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `value` varchar(191) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_payment_settings_name_created_by_unique` (`name`,`created_by`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_payment_settings`
--

LOCK TABLES `admin_payment_settings` WRITE;
/*!40000 ALTER TABLE `admin_payment_settings` DISABLE KEYS */;
INSERT INTO `admin_payment_settings` VALUES (1,'currency_symbol','$',1,NULL,NULL),(2,'currency','USD',1,NULL,NULL);
/*!40000 ALTER TABLE `admin_payment_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_socials`
--

DROP TABLE IF EXISTS `blog_socials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_socials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `enable_social_button` varchar(191) DEFAULT 'off',
  `enable_email` varchar(191) DEFAULT 'off',
  `enable_twitter` varchar(191) DEFAULT 'off',
  `enable_facebook` varchar(191) DEFAULT 'off',
  `enable_googleplus` varchar(191) DEFAULT 'off',
  `enable_linkedIn` varchar(191) DEFAULT 'off',
  `enable_pinterest` varchar(191) DEFAULT 'off',
  `enable_stumbleupon` varchar(191) DEFAULT 'off',
  `enable_whatsapp` varchar(191) DEFAULT 'off',
  `store_id` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_socials`
--

LOCK TABLES `blog_socials` WRITE;
/*!40000 ALTER TABLE `blog_socials` DISABLE KEYS */;
INSERT INTO `blog_socials` VALUES (1,'on','on','on','on','on','on','on','on','on',1,2,'2025-09-11 21:18:46','2025-09-11 21:18:46');
/*!40000 ALTER TABLE `blog_socials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) NOT NULL,
  `blog_cover_image` varchar(191) DEFAULT NULL,
  `detail` longtext DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `brand_img` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Becane','brand-1_1758024988.png','2025-09-12 03:12:13','2025-09-16 20:16:28',1),(7,'Docker','brand-4_1758025192.png','2025-09-16 20:19:52','2025-09-16 20:19:52',1),(8,'Ipone','brand-5_1758025229.png','2025-09-16 20:20:29','2025-09-16 20:20:29',1),(6,'Kymco','brand-3_1758025163.png','2025-09-16 20:19:23','2025-09-16 20:19:23',1),(5,'Cooper','brand-2_1758025145.png','2025-09-16 20:19:05','2025-09-16 20:19:05',1),(9,'Yamaha','brand-6_1758025246.png','2025-09-16 20:20:46','2025-09-16 20:20:46',1),(10,'Motul','brand-7_1758025872.png','2025-09-16 20:21:11','2025-09-16 20:31:12',1),(11,'Sanya','brand-8_1758025896.png','2025-09-16 20:31:36','2025-09-16 20:31:36',1),(12,'yadea','Yadea_Logo.svg_1758026137.png','2025-09-16 20:35:37','2025-09-16 20:35:37',1),(13,'Cimatti','my-store-logo-1585761467_1758027138.png','2025-09-16 20:52:18','2025-09-16 20:52:18',1),(14,'Motard','MTD-WP2_1758027527.png','2025-09-16 20:58:47','2025-09-16 20:58:47',1),(15,'Honda','Honda_Logo.svg_1758027624.png','2025-09-16 21:00:24','2025-09-16 21:00:24',1),(16,'Austin','ASDASDASDASDAS1_1758028499.png','2025-09-16 21:14:59','2025-09-16 21:14:59',1),(17,'Capuccino','bg,f8f8f8-flat,750x,075,f-pad,750x1000,f8f8f8.u6_1758028621.jpg','2025-09-16 21:17:01','2025-09-16 21:17:01',1),(18,'Becker','l589_1758030370.png','2025-09-16 21:46:10','2025-09-16 21:46:10',1),(21,'REPLAY','WhatsApp Image 2025-09-27 at 14.19.16_2ce9b469_1758979204.jpg','2025-09-27 17:20:04','2025-09-27 17:20:04',1);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chassis_numbers`
--

DROP TABLE IF EXISTS `chassis_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chassis_numbers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `chassis_number` varchar(191) NOT NULL,
  `variant_id` bigint(20) unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `location` varchar(191) NOT NULL DEFAULT 'DEPOT',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `chassis_numbers_chassis_number_unique` (`chassis_number`),
  KEY `chassis_numbers_chassis_number_index` (`chassis_number`),
  KEY `chassis_numbers_variant_id_index` (`variant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chassis_numbers`
--

LOCK TABLES `chassis_numbers` WRITE;
/*!40000 ALTER TABLE `chassis_numbers` DISABLE KEYS */;
INSERT INTO `chassis_numbers` VALUES (1,'32323',7,NULL,'DEPOT','2026-01-11 21:08:03','2026-01-11 21:08:03'),(2,'43434',7,NULL,'DEPOT','2026-01-11 21:08:15','2026-01-11 21:08:15'),(3,'DSADASD213213123',8,NULL,'DEPOT','2026-02-20 21:56:17','2026-02-20 21:56:17'),(4,'numerodechassis1',10,NULL,'DEPOT','2026-02-21 05:07:06','2026-02-21 05:07:06'),(5,'numerodechassis12sadsa',10,NULL,'DEPOT','2026-02-21 05:07:06','2026-02-21 05:07:06'),(6,'numerodechassis132131',10,NULL,'DEPOT','2026-02-21 05:07:06','2026-02-21 05:07:06'),(7,'LATXCBLY1S1902631',11,NULL,'DEPOT','2026-02-21 18:06:07','2026-02-21 18:06:07'),(8,'LATXCBLY1S1902663',11,NULL,'DEPOT','2026-02-21 18:06:39','2026-02-21 18:06:39'),(9,'LATXCBLY1S1902638',11,NULL,'DEPOT','2026-02-21 18:06:50','2026-02-21 18:06:50'),(10,'LATXCBLY1S1957162',11,NULL,'DEPOT','2026-02-21 18:07:31','2026-02-21 18:07:31'),(11,'LATXCBLY1S1957163',11,NULL,'DEPOT','2026-02-21 18:08:00','2026-02-21 18:08:00'),(12,'LATXCBLY1S1957908',11,NULL,'DEPOT','2026-02-21 18:08:22','2026-02-21 18:08:22'),(13,'LATXCBLY1S1957209',11,NULL,'DEPOT','2026-02-21 18:08:39','2026-02-21 18:08:39'),(14,'LATXCBLY1S1957822',11,NULL,'DEPOT','2026-02-21 18:08:55','2026-02-21 18:08:55'),(15,'LATXCBLY1S1957215',11,NULL,'DEPOT','2026-02-21 18:09:14','2026-02-21 18:09:14'),(16,'LATXCBLY1S1957237',11,NULL,'DEPOT','2026-02-21 18:09:31','2026-02-21 18:09:31'),(17,'LATXCBLY1S1957942',11,NULL,'DEPOT','2026-02-21 18:09:58','2026-02-21 18:09:58'),(18,'LATXCBLY1S1953515',12,NULL,'DEPOT','2026-02-21 18:37:29','2026-02-21 18:37:29'),(19,'LATXCBLY1S1953638',12,NULL,'DEPOT','2026-02-21 18:37:49','2026-02-21 18:37:49'),(20,'LATXCBLY1S1912516',12,NULL,'DEPOT','2026-02-21 18:38:06','2026-02-21 18:38:06'),(21,'LATXCBLY1S1918625',13,NULL,'DEPOT','2026-02-21 18:40:24','2026-02-21 18:40:24'),(22,'LATXCBLY1S1918626',13,NULL,'DEPOT','2026-02-21 18:40:45','2026-02-21 18:40:45'),(23,'LATXCBLY1S1911374',14,NULL,'DEPOT','2026-02-21 18:44:48','2026-02-21 18:44:48'),(24,'LATXCBLY1S1911273',14,NULL,'DEPOT','2026-02-21 18:45:32','2026-02-21 18:45:32'),(25,'LATXCBLY1S191291',14,NULL,'DEPOT','2026-02-21 18:48:40','2026-02-21 18:48:40'),(26,'LATXCBLY1S1951322',14,NULL,'DEPOT','2026-02-21 18:49:06','2026-02-21 18:49:06'),(27,'LATXCBLY1S1951342',14,NULL,'DEPOT','2026-02-21 18:49:18','2026-02-21 18:49:18'),(28,'LATXCBLY1S1951319',14,NULL,'DEPOT','2026-02-21 18:49:30','2026-02-21 18:49:30'),(29,'LATXCBLY2S1824840',15,NULL,'DEPOT','2026-02-21 19:28:25','2026-02-21 19:28:25'),(30,'LATXCBLY2S1824864',15,NULL,'DEPOT','2026-02-21 19:28:36','2026-02-21 19:28:36'),(31,'LATXCBLY2S1824707',15,NULL,'DEPOT','2026-02-21 19:28:51','2026-02-21 19:28:51'),(32,'LATXCBLY2S1824867',15,NULL,'DEPOT','2026-02-21 19:29:07','2026-02-21 19:29:07'),(33,'LATXCBLY2S1844869',16,NULL,'DEPOT','2026-02-21 19:32:01','2026-02-21 19:32:01'),(34,'LATXCBLY2S1844941',16,NULL,'DEPOT','2026-02-21 19:32:27','2026-02-21 19:32:27'),(35,'LATXCBLY2S1844948',16,NULL,'DEPOT','2026-02-21 19:32:40','2026-02-21 19:32:40'),(36,'LATXCBLY2S1846327',17,NULL,'DEPOT','2026-02-21 19:34:22','2026-02-21 19:34:22'),(37,'LATXCBLY2S1869417',18,NULL,'DEPOT','2026-02-21 19:35:26','2026-02-21 19:35:26'),(38,'LATXCBLY2S1869370',18,NULL,'DEPOT','2026-02-21 19:35:41','2026-02-21 19:35:41'),(39,'LATXCBLY2S1869381',18,NULL,'DEPOT','2026-02-21 19:37:12','2026-02-21 19:37:12'),(40,'05/02/2026',18,NULL,'DEPOT','2026-02-21 19:37:12','2026-02-21 19:37:12'),(41,'LATXCBLY2S1935853',19,NULL,'DEPOT','2026-02-21 19:48:04','2026-02-21 19:48:04'),(42,'LATXCBLY2S1936223',19,NULL,'DEPOT','2026-02-21 19:48:33','2026-02-21 19:48:33'),(43,'LATXCBLY2S1939329',19,NULL,'DEPOT','2026-02-21 19:48:52','2026-02-21 19:48:52'),(44,'LATXCBLY2S1936244',19,NULL,'DEPOT','2026-02-21 19:49:42','2026-02-21 19:49:42'),(45,'LATXCBLY2S1936239',19,NULL,'DEPOT','2026-02-21 19:50:07','2026-02-21 19:50:07'),(46,'LZRY7FAR1035165',20,NULL,'DEPOT','2026-02-21 19:58:03','2026-02-21 19:58:03'),(47,'DOCKER MILANO-GRIS/Noir',20,NULL,'DEPOT','2026-02-21 20:03:59','2026-02-21 20:03:59'),(48,'LRPBA2BORA204318',21,NULL,'DEPOT','2026-02-21 20:09:46','2026-02-21 20:09:46'),(49,'LRPBA2B9RA204334',21,NULL,'DEPOT','2026-02-21 20:10:25','2026-02-21 20:10:25'),(50,'LRPBA2B4RA204323',21,NULL,'DEPOT','2026-02-21 20:11:33','2026-02-21 20:11:33'),(51,'LCS1BKZP5S1427422',22,NULL,'DEPOT','2026-02-21 21:31:14','2026-02-21 21:31:14'),(52,'LATXCBLP41028842',23,NULL,'DEPOT','2026-02-21 21:33:44','2026-02-21 21:33:44'),(53,'L5YXGCBD0S1168531',24,NULL,'DEPOT','2026-02-21 21:48:59','2026-02-21 21:48:59'),(54,'SLFPACBB1ST000393',26,NULL,'DEPOT','2026-02-21 21:56:13','2026-02-21 21:56:13'),(55,'SLFPACBB8ST001363',26,NULL,'DEPOT','2026-02-21 21:59:21','2026-02-21 21:59:21'),(56,'SLFPACBB8ST001153',26,NULL,'DEPOT','2026-02-21 22:00:01','2026-02-21 22:00:01'),(57,'LZRY3F2K7R1000287',27,NULL,'DEPOT','2026-02-21 22:02:29','2026-02-21 22:02:29'),(58,'LZR3F2K4R1000991',27,NULL,'DEPOT','2026-02-21 22:03:21','2026-02-21 22:03:21'),(59,'LZRY3F2L9R1000607',28,NULL,'DEPOT','2026-02-21 22:06:12','2026-02-21 22:06:12'),(60,'L5YBYCBAXS1160689',29,NULL,'DEPOT','2026-02-21 22:26:46','2026-02-21 22:26:46'),(61,'L5YBYCBAXS1160588',29,NULL,'DEPOT','2026-02-21 22:29:26','2026-02-21 22:29:26'),(62,'LZRY3F2E9R1000107',25,NULL,'DEPOT','2026-02-21 22:33:23','2026-02-21 22:33:23'),(63,'L5YSHCBA4S1146089',30,NULL,'DEPOT','2026-02-21 22:34:57','2026-02-21 22:34:57'),(64,'test',32,'2026-04-12','DEPOT','2026-04-18 19:32:08','2026-04-18 19:32:08'),(66,'0655test',7,'2026-04-24','DEPOT','2026-04-25 12:42:59','2026-04-25 12:42:59'),(67,'test0354',7,'2026-04-25','SHOW-ROOM','2026-04-25 12:42:59','2026-04-25 12:42:59');
/*!40000 ALTER TABLE `chassis_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chassis_order_items`
--

DROP TABLE IF EXISTS `chassis_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chassis_order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `chassis_order_id` bigint(20) unsigned NOT NULL,
  `chassis_number_id` bigint(20) unsigned NOT NULL,
  `variant_id` bigint(20) unsigned NOT NULL,
  `chassis_number` varchar(191) NOT NULL,
  `model_name` varchar(191) DEFAULT NULL,
  `family_name` varchar(191) DEFAULT NULL,
  `brand_name` varchar(191) DEFAULT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `location` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chassis_order_items_chassis_order_id_index` (`chassis_order_id`),
  KEY `chassis_order_items_chassis_number_id_index` (`chassis_number_id`),
  KEY `chassis_order_items_variant_id_index` (`variant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chassis_order_items`
--

LOCK TABLES `chassis_order_items` WRITE;
/*!40000 ALTER TABLE `chassis_order_items` DISABLE KEYS */;
INSERT INTO `chassis_order_items` VALUES (1,1,68,33,'test1234','33','test','Becane',0.00,'SHOW-ROOM','2026-04-25 15:52:09','2026-04-25 15:52:09'),(2,1,70,35,'987654321','test1111','testino','Becane',5000.00,'SHOW-ROOM','2026-04-25 15:52:09','2026-04-25 15:52:09'),(3,2,69,35,'123456789','test1111','testino','Becane',5000.00,'DEPOT','2026-04-25 16:24:10','2026-04-25 16:24:10'),(4,3,65,32,'test 1','test','test','Becane',65320.00,'SHOW-ROOM','2026-04-25 16:31:09','2026-04-25 16:31:09');
/*!40000 ALTER TABLE `chassis_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chassis_orders`
--

DROP TABLE IF EXISTS `chassis_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chassis_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(191) NOT NULL,
  `customer_name` varchar(191) DEFAULT NULL,
  `customer_phone` varchar(191) DEFAULT NULL,
  `total_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `tva` decimal(5,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','validated','rejected') NOT NULL DEFAULT 'pending',
  `user_id` bigint(20) unsigned NOT NULL,
  `store_id` bigint(20) unsigned NOT NULL,
  `notes` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `chassis_orders_order_number_unique` (`order_number`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chassis_orders`
--

LOCK TABLES `chassis_orders` WRITE;
/*!40000 ALTER TABLE `chassis_orders` DISABLE KEYS */;
INSERT INTO `chassis_orders` VALUES (1,'CO-000001','OTHMAN','066666666',5000.00,0.00,0.00,'pending',2,1,'AVANCE 2000',NULL,'2026-04-25 15:52:09','2026-04-25 15:52:09'),(2,'CO-000002','OTHMAN','000000600',6000.00,0.00,20.00,'pending',2,1,'AVANCE 2000',NULL,'2026-04-25 16:24:10','2026-04-25 16:24:10'),(3,'CO-000003','reda','070707707',78384.00,0.00,20.00,'pending',2,1,'na','avance 40000dh','2026-04-25 16:31:09','2026-04-25 16:31:09');
/*!40000 ALTER TABLE `chassis_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `discount` double NOT NULL DEFAULT 0,
  `limit` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_domain_requests`
--

DROP TABLE IF EXISTS `custom_domain_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custom_domain_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `custom_domain` varchar(191) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_domain_requests`
--

LOCK TABLES `custom_domain_requests` WRITE;
/*!40000 ALTER TABLE `custom_domain_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_domain_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone_number` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `store_id` varchar(191) DEFAULT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `lang` varchar(191) NOT NULL DEFAULT 'en',
  `products_id` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_template_langs`
--

DROP TABLE IF EXISTS `email_template_langs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_template_langs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `lang` varchar(100) NOT NULL,
  `subject` varchar(191) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_template_langs`
--

LOCK TABLES `email_template_langs` WRITE;
/*!40000 ALTER TABLE `email_template_langs` DISABLE KEYS */;
INSERT INTO `email_template_langs` VALUES (1,1,'ar','Order Complete','<p>┘à╪▒╪¡╪¿╪º ╪î</p><p>┘à╪▒╪¡╪¿╪º ╪¿┘â ┘ü┘è {app_name}.</p><p>┘à╪▒╪¡╪¿╪º ╪î {order_name} ╪î ╪┤┘â╪▒╪º ┘ä┘ä╪¬╪│┘ê┘é</p><p>┘é┘à┘å╪º ╪¿╪º╪│╪¬┘ä╪º┘à ╪╖┘ä╪¿ ╪º┘ä╪┤╪▒╪º╪í ╪º┘ä╪«╪º╪╡ ╪¿┘â ╪î ╪│┘è╪¬┘à ╪º┘ä╪º╪¬╪╡╪º┘ä ╪¿┘â ┘é╪▒┘è╪¿╪º !</p><p>╪┤┘â╪▒╪º ╪î</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(2,1,'zh','Order Complete','<p>µé¿σÑ╜∩╝î</p><p>µ¼óΦ┐Äµ¥Ñσê░ {app_name}πÇé</p><p>µé¿σÑ╜∩╝î{order_name}∩╝îµäƒΦ░óµé¿τÜäΦ┤¡τë⌐</p><p>µêæΣ╗¼σ╖▓µö╢σê░µé¿τÜäΦ┤¡Σ╣░Φ»╖µ▒é∩╝îµêæΣ╗¼σ╛êσ┐½σ░▒Σ╝ÜΣ╕Äµé¿Φüöτ│╗∩╝ü</p><p>Φ░óΦ░ó∩╝î</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(3,1,'da','Order Complete','<p>Hej, &nbsp;</p><p>Velkommen til {app_name}.</p><p>Hej, {order_name}, tak for at Shopping</p><p>Vi har modtaget din k├╕bsanmodning.</p><p>Tak,</p><p>{app_navn}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(4,1,'de','Order Complete','<p>Hello, &nbsp;</p><p>Willkommen bei {app_name}.</p><p>Hi, {order_name}, Vielen Dank f├╝r Shopping</p><p>Wir haben Ihre Kaufanforderung erhalten, wir werden in K├╝rze in Kontakt sein!</p><p>Danke,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(5,1,'en','Order Complete','<p>Hello,&nbsp;</p><p>Welcome to {app_name}.</p><p>Hi, {order_name}, Thank you for Shopping</p><p>We received your purchase request, we\'ll be in touch shortly!</p><p>Thanks,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(6,1,'es','Order Complete','<p>Hola, &nbsp;</p><p>Bienvenido a {app_name}.</p><p>Hi, {order_name}, Thank you for Shopping</p><p>Recibimos su solicitud de compra, ┬íestaremos en contacto en breve!</p><p>Gracias,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(7,1,'fr','Order Complete','<p>Bonjour, &nbsp;</p><p>Bienvenue dans {app_name}.</p><p>Hi, {order_name}, Thank you for Shopping</p><p>We re├ºus your purchase request, we \'ll be in touch incess!</p><p>Thanks,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(8,1,'he','Order Complete','<p>╫⌐╫£╫ò╫¥,&nbsp;</p><p>╫æ╫¿╫ò╫Ü ╫ö╫æ╫É ╫£{app_name}.</p><p>╫ö╫Ö╫Ö, {order_name}, ╫¬╫ò╫ô╫ö ╫ó╫£ ╫ö╫º╫á╫Ö╫ò╫¬</p><p>╫º╫Ö╫æ╫£╫á╫ò ╫É╫¬ ╫æ╫º╫⌐╫¬ ╫ö╫¿╫¢╫Ö╫⌐╫ö ╫⌐╫£╫Ü, ╫á╫Ö╫ª╫ò╫¿ ╫º╫⌐╫¿ ╫æ╫º╫¿╫ò╫æ!</p><p>╫¬╫ò╫ô╫ö,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(9,1,'pt','Order Complete','<p>NAVE ├ôRICA-╨ó╤â╤é╤â╤é╤â╤é╤â╨│╨░╨╗╤î╤ü╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣ (app_name}).</p><p>Hi, {order_name}, ╨┐╨░╤ü╤ü╤ü╤ü╨║╨╕╨╣</p><p>╨┐╨╛╨╗╤î╤ü╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣ ╨┐╨╛╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣ (╨┐╨╛╤Ç╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣), \"╤ü╨║╨╛╤Ç╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣\".</p><p>nome_do_app╤ü╤ü╤ü╤ü╨║╨╕╨╣!</p><p>{app_name}</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(10,1,'it','Order Complete','<p>Ciao, &nbsp;</p><p>Benvenuti in {app_name}.</p><p>Ciao, {order_name}, Grazie per Shopping</p><p>Abbiamo ricevuto la tua richiesta di acquisto, noi \\ saremo in contatto a breve!</p><p>Grazie,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(11,1,'ja','Order Complete','<p>πüôπéôπü½πüíπü» &nbsp;</p><p>{app_name}πü╕πéêπüåπüôπü¥πÇé</p></p><p><p>πüôπéôπü½πüíπü»πÇü {order_name}πÇüπüèσ«óµºÿπü«Φ│╝Φ▓╖Φªüµ▒éµ¢╕πéÆπüèσÅùπüæσÅûπéèπüäπüƒπüáπüìπÇüπüÖπüÉπü½πüöΘÇúτ╡íπüäπüƒπüùπü╛πüÖπÇé</p><p>πüéπéèπüîπü¿πüåπüöπüûπüäπü╛πüÖπÇé</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(12,1,'nl','Order Complete','<p>Hallo, &nbsp;</p><p>Welkom bij {app_name}.</p><p>Hallo, {order_name}, Dank u voor Winkelen</p><p>We hebben uw aankoopaanvraag ontvangen, we zijn binnenkort in contact!</p><p>Bedankt,</p><p>{ app_name }</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(13,1,'pl','Order Complete','<p>Hello, &nbsp;</p><p>Witamy w aplikacji {app_name}.</p><p>Hi, {order_name}, Dzi─Ökujemy za zakupy</p><p>Otrzymamy Tw├│j wniosek o zakup, wkr├│tce b─Ödziemy w kontakcie!</p><p>Dzi─Öki,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(14,1,'ru','Order Complete','<p>╨ù╨┤╤Ç╨░╨▓╤ü╤é╨▓╤â╨╣╤é╨╡, &nbsp;</p><p>╨Æ╨░╤ü ╨┐╤Ç╨╕╨▓╨╡╤é╤ü╤é╨▓╤â╨╡╤é {app_name}.</p><p>Hi, {order_name}, ╨í╨┐╨░╤ü╨╕╨▒╨╛ ╨╖╨░ ╨¿╨╛╨┐╨┐╨╕╨╜╨│</p><p>╨£╤ï ╨┐╨╛╨╗╤â╤ç╨╕╨╗╨╕ ╨▓╨░╤ê ╨╖╨░╨┐╤Ç╨╛╤ü ╨╜╨░ ╨┐╨╛╨║╤â╨┐╨║╤â, ╨╝╤ï \\ ╤ü╨║╨╛╤Ç╨╛ ╤ü╨▓╤Å╨╢╨╡╨╝╤ü╤Å!</p><p>╨í╨┐╨░╤ü╨╕╨▒╨╛,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(15,1,'tr','Order Complete','<p>Merhaba,&nbsp;</p><p>{app_name}\'e ho┼ƒ geldiniz.</p><p>Merhaba {order_name}, Al─▒┼ƒveri┼ƒ i├ºin te┼ƒekk├╝r ederiz</p><p>Sat─▒n alma talebinizi ald─▒k, k─▒sa s├╝re i├ºinde sizinle ileti┼ƒime ge├ºece─ƒiz!</p><p>Te┼ƒekk├╝rler,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(16,1,'pt-br','Order Complete','<p>NAVE ├ôRICA-╨ó╤â╤é╤â╤é╤â╤é╤â╨│╨░╨╗╤î╤ü╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣ (app_name}).</p><p>Hi, {order_name}, ╨┐╨░╤ü╤ü╤ü╤ü╨║╨╕╨╣</p><p>╨┐╨╛╨╗╤î╤ü╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣ ╨┐╨╛╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣ (╨┐╨╛╤Ç╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣), \"╤ü╨║╨╛╤Ç╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣\".</p><p>nome_do_app╤ü╤ü╤ü╤ü╨║╨╕╨╣!</p><p>{app_name}</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(17,2,'ar','Order Status','<p> ┘à╪▒╪¡╪¿┘ï╪º ╪î </p> <p> ┘à╪▒╪¡╪¿┘ï╪º ╪¿┘â ┘ü┘è {app_name}. </p> <p> ╪╖┘ä╪¿┘â ┘ç┘ê {order_status}! </p> <p> ┘à╪▒╪¡╪¿┘ï╪º {order_name} ╪î ╪┤┘â╪▒┘ï╪º ┘ä┘â ╪╣┘ä┘ë ╪º┘ä╪¬╪│┘ê┘é </p> <p> ╪┤┘â╪▒┘ï╪º ╪î </ p> <p> {app_name} </p> <p> {order_url} </p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(18,2,'zh','Order Status','<p>µé¿σÑ╜∩╝î</p><p>µ¼óΦ┐Äµ¥Ñσê░ {app_name}πÇé</p><p>µé¿τÜäΦ«óσìòµÿ» {order_status}∩╝ü</p><p>µé¿σÑ╜{order_name}∩╝îµäƒΦ░óµé¿τÜäΦ┤¡τë⌐</p><p>Φ░óΦ░ó∩╝î</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(19,2,'da','Order Status','<p>Hej, &nbsp;</p><p>Velkommen til {app_name}.</p><p>Din ordre er {order_status}!</p><p>Hej {order_navn}, Tak for at Shopping</p><p>Tak,</p><p>{app_navn}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(20,2,'de','Order Status','<p>Hello, &nbsp;</p><p>Willkommen bei {app_name}.</p><p>Ihre Bestellung lautet {order_status}!</p><p>Hi {order_name}, Danke f├╝r Shopping</p><p>Danke,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(21,2,'en','Order Status','<p>Hello,&nbsp;</p><p>Welcome to {app_name}.</p><p>Your Order is {order_status}!</p><p>Hi {order_name}, Thank you for Shopping</p><p>Thanks,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(22,2,'es','Order Status','<p>Hola, &nbsp;</p><p>Bienvenido a {app_name}.</p><p>Your Order is {order_status}!</p><p>Hi {order_name}, Thank you for Shopping</p><p>Thanks,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(23,2,'fr','Order Status','<p>Bonjour, &nbsp;</p><p>Bienvenue dans {app_name}.</p><p>Votre commande est {order_status} !</p><p>Hi {order_name}, Thank you for Shopping</p><p>Thanks,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(24,2,'he','Order Status','<p>╫⌐╫£╫ò╫¥,&nbsp;</p><p>╫æ╫¿╫ò╫Ü ╫ö╫æ╫É ╫£ {app_name}.</p><p>╫ö╫ö╫û╫₧╫á╫ö ╫⌐╫£╫Ü ╫ö╫Ö╫É {order_status}!</p><p>╫ö╫Ö╫Ö {order_name}, ╫¬╫ò╫ô╫ö ╫ó╫£ ╫ö╫º╫á╫Ö╫ò╫¬</p><p>╫¬╫ò╫ô╫ö,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(25,2,'pt','Order Status','<p>SHOPPING CENTER-╨ó╤â╤é╤â╤é╤â╤é╤â╨│╨░╨╗╤î╤ü╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣ (app_name}).</p><p>nomeia ╨░╨╗╤î╤ü╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣ (order_status}!</p><p>Hi {order_name}, Obrigado por Shopping</p><p>Obrigado,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(26,2,'it','Order Status','<p>Ciao, &nbsp;</p><p>Benvenuti in {app_name}.</p><p>Il tuo ordine ├¿ {order_status}!</p><p>Ciao {order_name}, Grazie per Shopping</p><p>Grazie,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(27,2,'ja','Order Status','<p>Ciao, &nbsp;</p><p>Benvenuti in {app_name}.</p><p>Il tuo ordine ├¿ {order_status}!</p><p>Ciao {order_name}, Grazie per Shopping</p><p>Grazie,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(28,2,'nl','Order Status','<p>Hallo, &nbsp;</p><p>Welkom bij {app_name}.</p><p>Uw bestelling is {order_status}!</p><p>Hi {order_name}, Dank u voor Winkelen</p><p>Bedankt,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(29,2,'pl','Order Status','<p>Hello, &nbsp;</p><p>Witamy w aplikacji {app_name}.</p><p>Twoje zam├│wienie to {order_status}!</p><p>Hi {order_name}, Dzi─Ökujemy za zakupy</p><p>Thanks,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(30,2,'ru','Order Status','<p>╨ù╨┤╤Ç╨░╨▓╤ü╤é╨▓╤â╨╣╤é╨╡, &nbsp;</p><p>╨Æ╨░╤ü ╨┐╤Ç╨╕╨▓╨╡╤é╤ü╤é╨▓╤â╨╡╤é {app_name}.</p><p>╨Æ╨░╤ê ╨╖╨░╨║╨░╨╖-{order_status}!</p><p>Hi {order_name}, Thank you for Shopping</p><p>Thanks,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(31,2,'tr','Order Status','<p>Merhaba,&nbsp;</p><p>{app_name}\'e ho┼ƒ geldiniz.</p><p>Sipari┼ƒiniz {order_status}!</p><p>Merhaba {order_name}, Al─▒┼ƒveri┼ƒ i├ºin te┼ƒekk├╝rler </p><p>Te┼ƒekk├╝rler,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(32,2,'pt-br','Order Status','<p>SHOPPING CENTER-╨ó╤â╤é╤â╤é╤â╤é╤â╨│╨░╨╗╤î╤ü╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣ (app_name}).</p><p>nomeia ╨░╨╗╤î╤ü╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣ (order_status}!</p><p>Hi {order_name}, Obrigado por Shopping</p><p>Obrigado,</p><p>{app_name}</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(33,3,'ar','Order Detail','<p> ┘à╪▒╪¡╪¿┘ï╪º ╪î </ p> <p> ╪╣╪▓┘è╪▓┘è {owner_name}. </p> <p> ┘ç╪░╪º ╪ú┘à╪▒ ╪¬╪ú┘â┘è╪» {order_id} ╪╢╪╣┘ç ╪╣┘ä┘ë <span style = \\\"font-size: 1rem╪¢\\\"> {order_date}. </span> </p> <p> ╪┤┘â╪▒┘ï╪º ╪î </ p> <p> {order_url} </p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(34,3,'zh','Order Detail','<p>µé¿σÑ╜∩╝î</p><p>σ░èµò¼τÜä{owner_name}πÇé</p><p>Φ┐Öµÿ»τí«Φ«ñΦ«óσìò {order_id}∩╝îσ£░τé╣Σ╕║<span style=\\\"font-size: 1rem;\\\" >{order_date}πÇé</span></p><p>Φ░óΦ░ó∩╝î</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(35,3,'da','Order Detail','<p>Hej </p><p>K├ªre {owner_name}.</p><p>Dette er ordrebekr├ªftelse {order_id} sted p├Ñ <span style=\\\"font-size: 1rem;\\\">{order_date}. </span></p><p>Tak,</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(36,3,'de','Order Detail','<p>Hallo, </p><p>Sehr geehrter {owner_name}.</p><p>Dies ist die Auftragsbest├ñtigung {order_id}, die am <span style=\\\"font-size: 1rem;\\\">{order_date} aufgegeben wurde. </span></p><p>Danke,</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(37,3,'en','Order Detail','<p>Hello,&nbsp;</p><p>Dear {owner_name}.</p><p>This is Confirmation Order {order_id} place on&nbsp;<span style=\\\"font-size: 1rem;\\\">{order_date}.</span></p><p>Thanks,</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(38,3,'es','Order Detail','<p> Hola, </p> <p> Estimado {owner_name}. </p> <p> Este es el lugar de la orden de confirmaci├│n {order_id} en <span style = \\\"font-size: 1rem;\\\"> {order_date}. </span> </p> <p> Gracias, </p> <p> {order_url} </p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(39,3,'fr','Order Detail','<p>Bonjour, </p><p>Cher {owner_name}.</p><p>Ceci est la commande de confirmation {order_id} pass├⌐e le <span style=\\\"font-size: 1rem;\\\">{order_date}. </span></p><p>Merci,</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(40,3,'he','Order Detail','<p>╫⌐╫£╫ò╫¥,&nbsp;</p><p>╫Ö╓╕╫º╓╕╫¿ {owner_name}.</p><p>╫û╫ö╫ò ╫ª╫ò ╫É╫Ö╫⌐╫ò╫¿ {order_id} ╫₧╫º╫ò╫¥ ╫ó╫£&nbsp;<span style=\\\"font-size: 1rem;\\\">{order_date}.</span></p><p>╫¬╫ò╫ô╫ö,</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(41,3,'pt','Order Detail','<p> T├⌐rica-Dicas de Cadeia P├║blica de ╨ó╤â╤é╤â╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣ (owner_name}). </p> <p> ╨ó╤â╨│╨░╨╗╤î╤ü╤é╤â╨│╨░╨╗╤î╤ü╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣ (order_id} ╨╜╨╕╨╣ <span style = \\\" font-size: 1rem; \\ \"> {order_date}. </span> </p> <p> nome_do_chave de vida, </p> <p> {order_url} </p> <p> {order_url}','2025-09-11 21:18:46','2025-09-11 21:18:46'),(42,3,'it','Order Detail','<p>Ciao, </p><p>Gentile {owner_name}.</p><p>Questo ├¿ l\'ordine di conferma {order_id} effettuato su <span style=\\\"font-size: 1rem;\\\">{order_date}. </span></p><p>Grazie,</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(43,3,'ja','Order Detail','<p>πüôπéôπü½πüíπü»πÇü</ p> <p>Φª¬µä¢πü¬πéï{owner_name}πÇé</ p> <p>πüôπéîπü»πÇü<span style = \\\"font-size∩╝Ü1rem;\\\"> {order_date}πü«τó║Φ¬ìµ│¿µûç{order_id}πü«σá┤µëÇπüºπüÖπÇé </ span> </ p> <p>πüéπéèπüîπü¿πüåπüöπüûπüäπü╛πüÖ</ p> <p> {order_url} </ p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(44,3,'nl','Order Detail','<p>Hallo, </p><p>Beste {owner_name}.</p><p>Dit is de bevestigingsopdracht {order_id} die is geplaatst op <span style=\\\"font-size: 1rem;\\\">{order_date}. </span></p><p>Bedankt,</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(45,3,'pl','Order Detail','<p>Witaj, </p><p>Drogi {owner_name}.</p><p>To jest potwierdzenie zam├│wienia {order_id} z┼éo┼╝one na <span style=\\\"font-size: 1rem;\\\">{order_date}. </span></p><p>Dzi─Öki,</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(46,3,'ru','Order Detail','<p> ╨ù╨┤╤Ç╨░╨▓╤ü╤é╨▓╤â╨╣╤é╨╡, </p> <p> ╨ú╨▓╨░╨╢╨░╨╡╨╝╤ï╨╣ {owner_name}. </p> <p> ╨¡╤é╨╛ ╨┐╨╛╨┤╤é╨▓╨╡╤Ç╨╢╨┤╨╡╨╜╨╕╨╡ ╨╖╨░╨║╨░╨╖╨░ {order_id} ╨╜╨░ <span style = \\\"font-size: 1rem;\\\"> {order_date}. </span> </p> <p> ╨í╨┐╨░╤ü╨╕╨▒╨╛, </p> <p> {order_url} </p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(47,3,'tr','Order Detail','<p>Merhaba,&nbsp;</p><p>Sevgili {owner_name}.</p><p>Bu, {order_id} sipari┼ƒinin&nbsp;<span style=\\\"font-size: 1rem;\\\" ├╝zerindeki Onay Sipari┼ƒi yeridir. >{order_date}.</span></p><p>Te┼ƒekk├╝rler,</p><p>{order_url}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(48,3,'pt-br','Order Detail','<p> T├⌐rica-Dicas de Cadeia P├║blica de ╨ó╤â╤é╤â╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣ (owner_name}). </p> <p> ╨ó╤â╨│╨░╨╗╤î╤ü╤é╤â╨│╨░╨╗╤î╤ü╤é╤â╨│╨░╨╗╤î╤ü╨║╨╕╨╣ (order_id} ╨╜╨╕╨╣ <span style = \\\" font-size: 1rem; \\ \"> {order_date}. </span> </p> <p> nome_do_chave de vida, </p> <p> {order_url} </p> <p> {order_url}','2025-09-11 21:18:46','2025-09-11 21:18:46'),(49,4,'ar','Owner And Store Detail','<p>┘à╪▒╪¡╪¿┘ï╪º,<b> {owner_name} </b>!</p> <p>┘à╪▒╪¡╪¿┘ï╪º ╪¿┘â ┘ü┘è ╪º┘ä╪¬╪╖╪¿┘è┘é ╪º┘ä╪«╪º╪╡ ╪¿┘å╪º ╪¬┘ü╪º╪╡┘è┘ä ╪¬╪│╪¼┘è┘ä ╪º┘ä╪»╪«┘ê┘ä ╪º┘ä╪«╪º╪╡╪⌐ ╪¿┘Ç <b> {app_name}</b> ┘ç┘ê <br></p> <p><b>╪º┘ä╪¿╪▒┘è╪» ╪º┘ä╪Ñ┘ä┘â╪¬╪▒┘ê┘å┘è   : </b>{owner_email}</p> <p><b>┘â┘ä┘à╪⌐ ╪º┘ä┘à╪▒┘ê╪▒   : </b>{owner_password}</p> <p><b>╪╣┘å┘ê╪º┘å url ┘ä┘ä╪¬╪╖╪¿┘è┘é    : </b>{app_url}</p> <p><b>╪╣┘å┘ê╪º┘å URL ┘ä┘ä┘à╪¬╪¼╪▒: </b>{store_url}</p> <p>╪┤┘â╪▒╪º ┘ä╪¬┘ê╪º╪╡┘ä┘â ┘à╪╣┘å╪º╪î</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(50,4,'da','Owner And Store Detail','<p>Hej,<b> {owner_name} </b>!</p> <p>Velkommen til vores app, hvor du kan logge ind <b> {app_name}</b> er <br></p> <p><b>E-mail   : </b>{owner_email}</p> <p><b>Adgangskode : </b>{owner_password}</p> <p><b>App url    : </b>{app_url}</p> <p><b>Butiks-url: </b>{store_url}</p> <p> Tak fordi du tog kontakt med os,</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(51,4,'de','Owner And Store Detail','<p>Hallo,<b> {owner_name} </b>!</p> <p>Willkommen in unserer App f├╝r Ihre Login-Daten <b> {app_name}</b> ist <br></p> <p><b>Email   : </b>{owner_email}</p> <p><b>Passwort   : </b>{owner_password}</p> <p><b> App-URL    : </b>{app_url}</p> <p><b>Shop-URL: </b>{store_url}</p> <p>Danke, dass Sie sich mit uns verbunden haben,</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(52,4,'en','Owner And Store Detail','<p>Hello,<b> {owner_name} </b>!</p> <p>Welcome to our app yore login detail for <b> {app_name}</b> is <br></p> <p><b>Email   : </b>{owner_email}</p> <p><b>Password   : </b>{owner_password}</p> <p><b>App url    : </b>{app_url}</p> <p><b>Store url    : </b>{store_url}</p> <p>Thank you for connecting with us,</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(53,4,'es','Owner And Store Detail','<p>Hola,<b> {owner_name} </b>!</p> <p>Bienvenido a nuestra aplicaci├│n anta├▒o detalles de inicio de sesi├│n para <b> {app_name}</b> es <br></p> <p><b>Correo electr├│nico   : </b>{owner_email}</p> <p><b>Clave   : </b>{owner_password}</p> <p><b>URL de la aplicaci├│n  : </b>{app_url}</p> <p><b>URL de la tienda: </b>{store_url}</p> <p>Gracias por conectar con nosotras,</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(54,4,'fr','Owner And Store Detail','<p>Bonjour,<b> {owner_name} </b>!</p> <p>Bienvenue sur notre application autrefois les informations de connexion pour <b> {app_name}</b> est <br></p> <p><b>E-mail   : </b>{owner_email}</p> <p><b>Mot de passe   : </b>{owner_password}</p> <p><b>URL de l\'application   : </b>{app_url}</p> <p><b>URL du magasin┬á: </b>{store_url}</p> <p>Merci de nous avoir contact├⌐,</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(55,4,'it','Owner And Store Detail','<p>Ciao,<b> {owner_name} </b>!</p> <p>Benvenuto nella nostra app per i tuoi dati di accesso <b> {app_name}</b> ├¿ <br></p> <p><b>E-mail   : </b>{owner_email}</p> <p><b>Parola d\'ordine   : </b>{owner_password}</p> <p><b>URL dell\'app    : </b>{app_url}</p> <p><b>URL del negozio: </b>{store_url}</p> <p>Grazie per esserti connesso con noi,</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(56,4,'ja','Owner And Store Detail','<p>πüôπéôπü½πüíπü»,<b> {owner_name} </b>!</p> <p>τºüπüƒπüíπü«πéóπâùπâ¬πü«yoreπâ¡πé░πéñπâ│πü«Φ⌐│τ┤░πü╕πéêπüåπüôπü¥ <b> {app_name}</b> πü» <br></p> <p><b>Eπâíπâ╝πâ½   : </b>{owner_email}</p> <p><b>πâæπé╣πâ»πâ╝πâë   : </b>{owner_password}</p> <p><b>πéóπâùπâ¬πü«URL    : </b>{app_url}</p> <p><b>πé╣πâêπéóπü« URL : </b>{store_url}</p> <p>πüöΘÇúτ╡íπüéπéèπüîπü¿πüåπüöπüûπüäπü╛πüÖ,</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(57,4,'nl','Owner And Store Detail','<p>Hallo,<b> {owner_name} </b>!</p> <p>Welkom bij de inloggegevens van onze app voor: <b> {app_name}</b> is <br></p> <p><b>E-mail   : </b>{owner_email}</p> <p><b>Wachtwoord   : </b>{owner_password}</p> <p><b>App-URL    : </b>{app_url}</p> <p><b>Winkel-URL: </b>{winkel_url</p> <p>Bedankt voor het contact met ons,</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(58,4,'pl','Owner And Store Detail','<p>Witam,<b> {owner_name} </b>!</p> <p>Witamy w naszej aplikacji yore dane logowania do <b> {app_name}</b> jest <br></p> <p><b>E-mail   : </b>{owner_email}</p> <p><b>Has┼éo   : </b>{owner_password}</p> <p><b>URL aplikacji    : </b>{app_url}</p> <p><b>Adres sklepu: </b>{store_url}</p> <p>Dzi─Ökujemy za kontakt z nami,</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(59,4,'ru','Owner And Store Detail','<p>╨ƒ╤Ç╨╕╨▓╨╡╤é,<b> {owner_name} </b>!</p> <p>╨ö╨╛╨▒╤Ç╨╛ ╨┐╨╛╨╢╨░╨╗╨╛╨▓╨░╤é╤î ╨▓ ╨╜╨░╤ê╨╡ ╨┐╤Ç╨╕╨╗╨╛╨╢╨╡╨╜╨╕╨╡. <b> {app_name}</b> ╤Å╨▓╨╗╤Å╨╡╤é╤ü╤Å <br></p> <p><b>╨¡╨╗. ╨░╨┤╤Ç╨╡╤ü   : </b>{owner_email}</p> <p><b>╨ƒ╨░╤Ç╨╛╨╗╤î   : </b>{owner_password}</p> <p><b>URL ╨┐╤Ç╨╕╨╗╨╛╨╢╨╡╨╜╨╕╤Å    : </b>{app_url}</p> <p><b>URL-╨░╨┤╤Ç╨╡╤ü ╨╝╨░╨│╨░╨╖╨╕╨╜╨░: </b>{store_url}</p> <p>╨í╨┐╨░╤ü╨╕╨▒╨╛, ╤ç╤é╨╛ ╤ü╨▓╤Å╨╖╨░╨╗╨╕╤ü╤î ╤ü ╨╜╨░╨╝╨╕,</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(60,4,'pt','Owner And Store Detail','<p>Ol├í,<b> {owner_name} </b>!</p> <p>Bem-vindo ao nosso aplicativo antigo detalhe de login para <b> {app_name}</b> ├⌐ <br></p> <p><b>E-mail   : </b>{owner_email}</p> <p><b>Senha   : </b>{owner_password}</p> <p><b>URL do aplicativo    : </b>{app_url}</p> <p><b>URL da loja: </b>{store_url}</p> <p>Obrigado por conectar com a gente,</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(61,4,'tr','Owner And Store Detail','<p>Merhaba,<b> {owner_name} </b>!</p> <p>Uygulamam─▒za ho┼ƒ geldiniz, eski <b> {app_name}</b> i├ºin giri┼ƒ ayr─▒nt─▒s─▒ <br></p> <p><b>E-posta : </b>{owner_email}</p> <p><b>┼₧ifre : </b>{owner_password}</p> <p><b>Uygulama url : </b>{app_url}</p> <p><b>Ma─ƒaza URL si : </b>{store_url}</p> <p>Bizimle ba─ƒlant─▒ kurdu─ƒunuz i├ºin te┼ƒekk├╝r ederiz,</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(62,4,'he','Owner And Store Detail','<p>╫⌐╫£╫ò╫¥,<b> {owner_name} </b>!</p> <p>╫æ╫¿╫ò╫Ü ╫ö╫æ╫É ╫£╫É╫ñ╫£╫Ö╫º╫ª╫Ö╫ö ╫⌐╫£╫á╫ò, ╫ñ╫¿╫ÿ╫Ö ╫ö╫ö╫¬╫ù╫æ╫¿╫ò╫¬ ╫⌐╫£ <b> {app_name}</b> ╫ö╫ò╫É <br></p> <p><b>╫ô╫ò╫É\"╫£: </b>{owner_email}</p> <p><b>╫í╫Ö╫í╫₧╫ö: </b>{owner_password}</p> <p><b>╫¢╫¬╫ò╫æ╫¬ ╫É╫¬╫¿ ╫⌐╫£ ╫É╫ñ╫£╫Ö╫º╫ª╫Ö╫ö: </b>{app_url}</p> <p><b>╫¢╫¬╫ò╫æ╫¬ ╫É╫¬╫¿ ╫⌐╫£ ╫ù╫á╫ò╫¬: </b>{store_url}</p> <p>╫¬╫ò╫ô╫ö ╫⌐╫ö╫¬╫ù╫æ╫¿╫¬ ╫É╫£╫Ö╫á╫ò,</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(63,4,'zh','Owner And Store Detail','<p>µé¿σÑ╜∩╝î<b> {owner_name} </b>∩╝ü</p> <p>µ¼óΦ┐ÄΣ╜┐τö¿µêæΣ╗¼τÜäσ║öτö¿∩╝î<b> {app_name}</b> τÜäτÖ╗σ╜òΦ»ªτ╗åΣ┐íµü»µÿ»<br></p> <p><b>τö╡σ¡ÉΘé«Σ╗╢∩╝Ü</b>{owner_email}</p> <p><b>σ»åτáü∩╝Ü</b>{owner_password}</p> <p><b>σ║öτö¿τ¿ïσ║Åτ╜æσ¥Ç∩╝Ü</b>{app_url}</p> <p><b>σòåσ║ùτ╜æσ¥Ç∩╝Ü</b>{store_url}</p> <p>µäƒΦ░óµé¿Σ╕ÄµêæΣ╗¼Φüöτ│╗∩╝î</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46'),(64,4,'pt-br','Owner And Store Detail','<p>Ol├í,<b> {owner_name} </b>!</p> <p>Bem-vindo ao nosso aplicativo antigo detalhe de login para <b> {app_name}</b> ├⌐ <br></p> <p><b>E-mail   : </b>{owner_email}</p> <p><b>Senha   : </b>{owner_password}</p> <p><b>URL do aplicativo    : </b>{app_url}</p> <p><b>URL da loja: </b>{store_url}</p> <p>Obrigado por conectar com a gente,</p> <p>{app_name}</p>','2025-09-11 21:18:46','2025-09-11 21:18:46');
/*!40000 ALTER TABLE `email_template_langs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `from` varchar(191) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES (1,'Order Created','gestion.mobi-nardo.com',1,'2025-09-11 21:18:46','2025-09-11 21:18:46'),(2,'Status Change','gestion.mobi-nardo.com',1,'2025-09-11 21:18:46','2025-09-11 21:18:46'),(3,'Order Created For Owner','gestion.mobi-nardo.com',1,'2025-09-11 21:18:46','2025-09-11 21:18:46'),(4,'Owner And Store Created','gestion.mobi-nardo.com',1,'2025-09-11 21:18:46','2025-09-11 21:18:46');
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `express_checkout`
--

DROP TABLE IF EXISTS `express_checkout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `express_checkout` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `variant_name` varchar(191) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(191) NOT NULL,
  `url` varchar(191) NOT NULL,
  `store_id` varchar(191) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `express_checkout`
--

LOCK TABLES `express_checkout` WRITE;
/*!40000 ALTER TABLE `express_checkout` DISABLE KEYS */;
/*!40000 ALTER TABLE `express_checkout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `join_us`
--

DROP TABLE IF EXISTS `join_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `join_us` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `join_us_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `join_us`
--

LOCK TABLES `join_us` WRITE;
/*!40000 ALTER TABLE `join_us` DISABLE KEYS */;
/*!40000 ALTER TABLE `join_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing_page_settings`
--

DROP TABLE IF EXISTS `landing_page_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landing_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `value` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `landing_page_settings_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing_page_settings`
--

LOCK TABLES `landing_page_settings` WRITE;
/*!40000 ALTER TABLE `landing_page_settings` DISABLE KEYS */;
INSERT INTO `landing_page_settings` VALUES (1,'topbar_status','on','2025-09-11 21:18:47','2025-09-11 21:18:47'),(2,'topbar_notification_msg','70% Special Offer. DonΓÇÖt Miss it. The offer ends in 72 hours.','2025-09-11 21:18:47','2025-09-11 21:18:47'),(3,'menubar_status','on','2025-09-11 21:18:47','2025-09-11 21:18:47'),(4,'menubar_page','[{\"menubar_page_name\": \"About Us\",\"template_name\": \"page_content\",\"page_url\": \"\",\"menubar_page_contant\": \"Welcome to the Storego website. By accessing this website, you agree to comply with and be bound by the following terms and conditions of use. If you disagree with any part of these terms, please do not use our website. The content of the pages of this website is for your general information and use only. It is subject to change without notice. This website uses cookies to monitor browsing preferences. If you do allow cookies to be used, personal information may be stored by us for use by third parties. Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness, or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors, and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law. Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services, or information available through this website meet your specific requirements. This website contains material that is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance, and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions. Unauthorized use of this website may give rise to a claim for damages and\\/or be a criminal offense. From time to time, this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s\",\"page_slug\": \"about_us\",\"header\": \"on\",\"footer\": \"on\",\"login\": \"on\"},{\"menubar_page_name\": \"Terms and Conditions\",\"template_name\": \"page_content\",\"page_url\": \"\",\"menubar_page_contant\": \"Welcome to the Storego website. By accessing this website, you agree to comply with and be bound by the following terms and conditions of use. If you disagree with any part of these terms, please do not use our website.\\r\\n\\r\\nThe content of the pages of this website is for your general information and use only. It is subject to change without notice.\\r\\n\\r\\nThis website uses cookies to monitor browsing preferences. If you do allow cookies to be used, personal information may be stored by us for use by third parties.\\r\\n\\r\\nNeither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness, or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors, and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.\\r\\n\\r\\nYour use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services, or information available through this website meet your specific requirements.\\r\\n\\r\\nThis website contains material that is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance, and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.\\r\\n\\r\\nUnauthorized use of this website may give rise to a claim for damages and\\/or be a criminal offense.\\r\\n\\r\\nFrom time to time, this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).\",\"page_slug\": \"terms_and_conditions\",\"header\": \"off\",\"footer\": \"on\",\"login\": \"on\"},{\"menubar_page_name\": \"Privacy Policy\",\"template_name\": \"page_content\",\"page_url\": \"\",\"menubar_page_contant\": \"Introduction: An overview of the privacy policy, including the purpose and scope of the policy. Information Collection: Details about the types of information collected from users\\/customers, such as personal information (name, address, email), device information, usage data, and any other relevant data. Data Usage: An explanation of how the collected data will be used, including providing services, improving products, personalization, analytics, and any other legitimate business purposes. Data Sharing: Information about whether and how the company shares user data with third parties, such as partners, service providers, or affiliates, along with the purposes of such sharing. Data Security: Details about the measures taken to protect user data from unauthorized access, loss, or misuse, including encryption, secure protocols, access controls, and data breach notification procedures. User Choices: Information on the choices available to users regarding the collection, use, and sharing of their personal data, including opt-out mechanisms and account settings. Cookies and Tracking Technologies: Explanation of the use of cookies, web beacons, and similar technologies for tracking user activity and collecting information for analytics and advertising purposes. Third-Party Links: Clarification that the companys website or services may contain links to third-party websites or services and that the privacy policy does not extend to those external sites. Data Retention: Details about the retention period for user data and how long it will be stored by the company. Legal Basis and Compliance: Information about the legal basis for processing personal data, compliance with applicable data protection laws, and the rights of users under relevant privacy regulations (e.g., GDPR, CCPA). Updates to the Privacy Policy: Notification that the privacy policy may be updated from time to time, and how users will be informed of any material changes. Contact Information: How users can contact the company regarding privacy-related concerns or inquiries.\",\"page_slug\": \"privacy_policy\",\"header\": \"off\",\"footer\": \"on\",\"login\": \"on\"}]','2025-09-11 21:18:47','2025-09-11 21:18:47'),(5,'site_logo','site_logo.png','2025-09-11 21:18:47','2025-09-11 21:18:47'),(6,'site_description','We build modern web tools to help you jump-start your daily business work.','2025-09-11 21:18:47','2025-09-11 21:18:47'),(7,'home_status','on','2025-09-11 21:18:47','2025-09-11 21:18:47'),(8,'home_offer_text','70% Special Offer','2025-09-11 21:18:47','2025-09-11 21:18:47'),(9,'home_title','Home','2025-09-11 21:18:47','2025-09-11 21:18:47'),(10,'home_heading','StoreGo SaaS Online Store Builder','2025-09-11 21:18:47','2025-09-11 21:18:47'),(11,'home_description','Use these awesome forms to login or create new account in your project for free.','2025-09-11 21:18:47','2025-09-11 21:18:47'),(12,'home_trusted_by','1000+ Customer','2025-09-11 21:18:47','2025-09-11 21:18:47'),(13,'home_live_demo_link','https://demo.workdo.io/storego-saas/login','2025-09-11 21:18:47','2025-09-11 21:18:47'),(14,'home_buy_now_link','https://codecanyon.net/item/storego-saas-online-store-builder/31116337','2025-09-11 21:18:47','2025-09-11 21:18:47'),(15,'home_banner','home_banner.png','2025-09-11 21:18:47','2025-09-11 21:18:47'),(16,'home_logo','home_logo.png,home_logo.png,home_logo.png,home_logo.png,home_logo.png,home_logo.png,home_logo.png','2025-09-11 21:18:47','2025-09-11 21:18:47'),(17,'feature_status','on','2025-09-11 21:18:47','2025-09-11 21:18:47'),(18,'feature_title','Features','2025-09-11 21:18:47','2025-09-11 21:18:47'),(19,'feature_heading','StoreGo SaaS Online Store Builder','2025-09-11 21:18:47','2025-09-11 21:18:47'),(20,'feature_description','Use these awesome forms to login or create new account in your project for free. Use these awesome forms to login or create new account in your project for free.','2025-09-11 21:18:47','2025-09-11 21:18:47'),(21,'feature_buy_now_link','https://codecanyon.net/item/storego-saas-online-store-builder/31116337','2025-09-11 21:18:47','2025-09-11 21:18:47'),(22,'feature_of_features','[{\"feature_logo\":\"1688011614-feature_logo.png\",\"feature_heading\":\"Feature\",\"feature_description\":\"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\\/p>\"},{\"feature_logo\":\"1688011268-feature_logo.png\",\"feature_heading\":\"Support\",\"feature_description\":\"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\\/p>\"},{\"feature_logo\":\"1688011285-feature_logo.png\",\"feature_heading\":\"Integration\",\"feature_description\":\"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\\/p>\"}]','2025-09-11 21:18:47','2025-09-11 21:18:47'),(23,'highlight_feature_heading','StoreGo SaaS Online Store Builder','2025-09-11 21:18:47','2025-09-11 21:18:47'),(24,'highlight_feature_description','Use these awesome forms to login or create new account in your project for free.','2025-09-11 21:18:47','2025-09-11 21:18:47'),(25,'highlight_feature_image','highlight_feature_image.png','2025-09-11 21:18:47','2025-09-11 21:18:47'),(26,'other_features','[{\"other_features_image\":\"1688014543-other_features_image.png\",\"other_features_heading\":\"StoreGo SaaS Online Store Builder\",\"other_featured_description\":\"<p>Use these awesome forms to login or create new account in your project for free.<\\/p>\",\"other_feature_buy_now_link\":\"https:\\/\\/codecanyon.net\\/item\\/storego-saas-online-store-builder\\/31116337\"},{\"other_features_image\":\"1688014582-other_features_image.png\",\"other_features_heading\":\"StoreGo SaaS Online Store Builder\",\"other_featured_description\":\"<p>Use these awesome forms to login or create new account in your project for free.<\\/p>\",\"other_feature_buy_now_link\":\"https:\\/\\/codecanyon.net\\/item\\/storego-saas-online-store-builder\\/31116337\"},{\"other_features_image\":\"1688013007-other_features_image.png\",\"other_features_heading\":\"StoreGo SaaS Online Store Builder\",\"other_featured_description\":\"<p>Use these awesome forms to login or create new account in your project for free.<\\/p>\",\"other_feature_buy_now_link\":\"https:\\/\\/codecanyon.net\\/item\\/storego-saas-online-store-builder\\/31116337\"},{\"other_features_image\":\"1688354824-other_features_image.png\",\"other_features_heading\":\"StoreGo SaaS Online Store Builder\",\"other_featured_description\":\"<p>Use these awesome forms to login or create new account in your project for free.<\\/p>\",\"other_feature_buy_now_link\":\"https:\\/\\/codecanyon.net\\/item\\/storego-saas-online-store-builder\\/31116337\"}]','2025-09-11 21:18:47','2025-09-11 21:18:47'),(27,'discover_status','on','2025-09-11 21:18:47','2025-09-11 21:18:47'),(28,'discover_heading','StoreGo SaaS Online Store Builder','2025-09-11 21:18:47','2025-09-11 21:18:47'),(29,'discover_description','Use these awesome forms to login or create new account in your project for free.','2025-09-11 21:18:47','2025-09-11 21:18:47'),(30,'discover_live_demo_link','https://demo.workdo.io/storego-saas/login','2025-09-11 21:18:47','2025-09-11 21:18:47'),(31,'discover_buy_now_link','https://codecanyon.net/item/storego-saas-online-store-builder/31116337','2025-09-11 21:18:47','2025-09-11 21:18:47'),(32,'discover_of_features','[{\"discover_logo\":\"1688011434-discover_logo.png\",\"discover_heading\":\"Feature\",\"discover_description\":\"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\\/p>\"},{\"discover_logo\":\"1688011321-discover_logo.png\",\"discover_heading\":\"Feature\",\"discover_description\":\"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\\/p>\"},{\"discover_logo\":\"1688011340-discover_logo.png\",\"discover_heading\":\"Feature\",\"discover_description\":\"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\\/p>\"},{\"discover_logo\":\"1688011348-discover_logo.png\",\"discover_heading\":\"Feature\",\"discover_description\":\"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\\/p>\"},{\"discover_logo\":\"1688011358-discover_logo.png\",\"discover_heading\":\"Feature\",\"discover_description\":\"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\\/p>\"},{\"discover_logo\":\"1688011369-discover_logo.png\",\"discover_heading\":\"Feature\",\"discover_description\":\"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\\/p>\"},{\"discover_logo\":\"1688011378-discover_logo.png\",\"discover_heading\":\"Feature\",\"discover_description\":\"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\\/p>\"},{\"discover_logo\":\"1688011386-discover_logo.png\",\"discover_heading\":\"Feature\",\"discover_description\":\"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\\/p>\"}]','2025-09-11 21:18:47','2025-09-11 21:18:47'),(33,'screenshots_status','on','2025-09-11 21:18:47','2025-09-11 21:18:47'),(34,'screenshots_heading','StoreGo SaaS Online Store Builder','2025-09-11 21:18:47','2025-09-11 21:18:47'),(35,'screenshots_description','Use these awesome forms to login or create new account in your project for free.','2025-09-11 21:18:47','2025-09-11 21:18:47'),(36,'screenshots','[{\"screenshots\":\"1688360824-screenshots.png\",\"screenshots_heading\":\"Products\"},{\"screenshots\":\"1688360831-screenshots.png\",\"screenshots_heading\":\"product View\"},{\"screenshots\":\"1688360835-screenshots.png\",\"screenshots_heading\":\"Brand Settings\"},{\"screenshots\":\"1688360841-screenshots.png\",\"screenshots_heading\":\"Overview\"},{\"screenshots\":\"1688360845-screenshots.png\",\"screenshots_heading\":\"Shipping\"},{\"screenshots\":\"1688360850-screenshots.png\",\"screenshots_heading\":\"Themes\"}]','2025-09-11 21:18:47','2025-09-11 21:18:47'),(37,'plan_status','on','2025-09-11 21:18:47','2025-09-11 21:18:47'),(38,'plan_title','Plan','2025-09-11 21:18:47','2025-09-11 21:18:47'),(39,'plan_heading','Online Store Builder System','2025-09-11 21:18:47','2025-09-11 21:18:47'),(40,'plan_description','Use these awesome forms to login or create new account in your project for free.','2025-09-11 21:18:47','2025-09-11 21:18:47'),(41,'faq_status','on','2025-09-11 21:18:47','2025-09-11 21:18:47'),(42,'faq_title','Faq','2025-09-11 21:18:47','2025-09-11 21:18:47'),(43,'faq_heading','StoreGo SaaS Online Store Builder','2025-09-11 21:18:47','2025-09-11 21:18:47'),(44,'faq_description','Use these awesome forms to login or create new account in your project for free.','2025-09-11 21:18:47','2025-09-11 21:18:47'),(45,'faqs','[{\"faq_questions\":\"#What does \\\"Theme\\/Package Installation\\\" mean?\",\"faq_answer\":\"For an easy-to-install theme\\/package, we have included step-by-step detailed documentation (in English). However, if it is not done perfectly, please feel free to contact the support team at support@workdo.io\"},{\"faq_questions\":\"#What does \\\"Theme\\/Package Installation\\\" mean?\",\"faq_answer\":\"For an easy-to-install theme\\/package, we have included step-by-step detailed documentation (in English). However, if it is not done perfectly, please feel free to contact the support team at support@workdo.io\"},{\"faq_questions\":\"#What does \\\"Lifetime updates\\\" mean?\",\"faq_answer\":\"For an easy-to-install theme\\/package, we have included step-by-step detailed documentation (in English). However, if it is not done perfectly, please feel free to contact the support team at support@workdo.io\"},{\"faq_questions\":\"#What does \\\"Lifetime updates\\\" mean?\",\"faq_answer\":\"For an easy-to-install theme\\/package, we have included step-by-step detailed documentation (in English). However, if it is not done perfectly, please feel free to contact the support team at support@workdo.io\"},{\"faq_questions\":\"# What does \\\"6 months of support\\\" mean?\",\"faq_answer\":\"Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa\\r\\n                                    nesciunt\\r\\n                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt\\r\\n                                    sapiente ea\\r\\n                                    proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven heard of them accusamus labore sustainable VHS.\"},{\"faq_questions\":\"# What does \\\"6 months of support\\\" mean?\",\"faq_answer\":\"Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa\\r\\n                                    nesciunt\\r\\n                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt\\r\\n                                    sapiente ea\\r\\n                                    proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven heard of them accusamus labore sustainable VHS.\"}]','2025-09-11 21:18:47','2025-09-11 21:18:47'),(46,'testimonials_status','on','2025-09-11 21:18:47','2025-09-11 21:18:47'),(47,'testimonials_heading','From our Clients','2025-09-11 21:18:47','2025-09-11 21:18:47'),(48,'testimonials_description','Use these awesome forms to login or create new account in your project for free.','2025-09-11 21:18:47','2025-09-11 21:18:47'),(49,'testimonials_long_description','WorkDo seCommerce package offers you a ΓÇ£sales-ready.ΓÇ¥secure online store. The package puts all the key pieces together, from design to payment processing. This gives you a headstart in your eCommerce venture. Every store is built using a reliable PHP framework -laravel. Thisspeeds up the development process while increasing the storeΓÇÖs security and performance.Additionally, thanks to the accompanying mobile app, you and your team can manage the store on the go. WhatΓÇÖs more, because the app works both for you and your customers, you can use it to reach a wider audience.And, unlike popular eCommerce platforms, it doesnΓÇÖt bind you to any terms and conditions or recurring fees. You get to choose where you host it or which payment gateway you use. Lastly, you getcomplete control over the looks of the store. And if it lacks any functionalities that you need, just reach out, and letΓÇÖs discuss customization possibilities','2025-09-11 21:18:47','2025-09-11 21:18:47'),(50,'testimonials','[{\"testimonials_user_avtar\":\"1688037601-testimonials_user_avtar.jpg\",\"testimonials_title\":\"Tbistone\",\"testimonials_description\":\"Very quick customer support, installing this application on my machine locally, within 5 minutes of creating a ticket, the developer was able to fix the issue I had within 10 minutes. EXCELLENT! Thank you very much\",\"testimonials_user\":\"Chordsnstrings\",\"testimonials_designation\":\"from codecanyon\",\"testimonials_star\":\"4\"},{\"testimonials_user_avtar\":\"1688037608-testimonials_user_avtar.png\",\"testimonials_title\":\"Tbistone\",\"testimonials_description\":\"Very quick customer support, installing this application on my machine locally, within 5 minutes of creating a ticket, the developer was able to fix the issue I had within 10 minutes. EXCELLENT! Thank you very much\",\"testimonials_user\":\"Chordsnstrings\",\"testimonials_designation\":\"from codecanyon\",\"testimonials_star\":\"4\"},{\"testimonials_user_avtar\":\"1688037657-testimonials_user_avtar.jpg\",\"testimonials_title\":\"Tbistone\",\"testimonials_description\":\"Very quick customer support, installing this application on my machine locally, within 5 minutes of creating a ticket, the developer was able to fix the issue I had within 10 minutes. EXCELLENT! Thank you very much\",\"testimonials_user\":\"Chordsnstrings\",\"testimonials_designation\":\"from codecanyon\",\"testimonials_star\":\"4\"}]','2025-09-11 21:18:47','2025-09-11 21:18:47'),(51,'footer_status','on','2025-09-11 21:18:47','2025-09-11 21:18:47'),(52,'joinus_status','on','2025-09-11 21:18:47','2025-09-11 21:18:47'),(53,'joinus_heading','Join Our Community','2025-09-11 21:18:47','2025-09-11 21:18:47'),(54,'joinus_description','We build modern web tools to help you jump-start your daily business work.','2025-09-11 21:18:47','2025-09-11 21:18:47');
/*!40000 ALTER TABLE `landing_page_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) NOT NULL,
  `fullName` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'ar','Arabic','2025-09-11 21:18:46','2025-09-11 21:18:46'),(2,'zh','Chinese','2025-09-11 21:18:46','2025-09-11 21:18:46'),(3,'da','Danish','2025-09-11 21:18:46','2025-09-11 21:18:46'),(4,'de','German','2025-09-11 21:18:46','2025-09-11 21:18:46'),(5,'en','English','2025-09-11 21:18:46','2025-09-11 21:18:46'),(6,'es','Spanish','2025-09-11 21:18:46','2025-09-11 21:18:46'),(7,'fr','French','2025-09-11 21:18:46','2025-09-11 21:18:46'),(8,'he','Hebrew','2025-09-11 21:18:46','2025-09-11 21:18:46'),(9,'it','Italian','2025-09-11 21:18:46','2025-09-11 21:18:46'),(10,'ja','Japanese','2025-09-11 21:18:46','2025-09-11 21:18:46'),(11,'nl','Dutch','2025-09-11 21:18:46','2025-09-11 21:18:46'),(12,'pl','Polish','2025-09-11 21:18:46','2025-09-11 21:18:46'),(13,'pt','Portuguese','2025-09-11 21:18:46','2025-09-11 21:18:46'),(14,'ru','Russian','2025-09-11 21:18:46','2025-09-11 21:18:46'),(15,'tr','Turkish','2025-09-11 21:18:46','2025-09-11 21:18:46'),(16,'pt-br','Portuguese(Brazil)','2025-09-11 21:18:46','2025-09-11 21:18:46');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_16_144239_create_plans_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_09_28_102009_create_settings_table',1),(6,'2019_12_14_000001_create_personal_access_tokens_table',1),(7,'2020_04_12_095629_create_coupons_table',1),(8,'2020_04_12_120749_create_user_coupons_table',1),(9,'2020_05_02_075614_create_email_templates_table',1),(10,'2020_05_02_075630_create_email_template_langs_table',1),(11,'2020_05_02_075647_create_user_email_templates_table',1),(12,'2020_05_21_065337_create_permission_tables',1),(13,'2021_02_02_085506_create_stores_table',1),(14,'2021_02_02_094240_create_user_stores_table',1),(15,'2021_02_03_093659_create_product_categories_table',1),(16,'2021_02_03_110342_create_product_taxes_table',1),(17,'2021_02_03_112228_create_shippings_table',1),(18,'2021_02_04_034943_create_products_table',1),(19,'2021_02_06_042547_create_subscriptions_table',1),(20,'2021_02_08_063716_create_product_images_table',1),(21,'2021_02_13_053126_create_orders_table',1),(22,'2021_02_15_071203_create_user_details_table',1),(23,'2021_02_17_070453_create_rattings_table',1),(24,'2021_02_26_061007_create_visits_table',1),(25,'2021_03_04_110817_create_plan_orders_table',1),(26,'2021_03_23_094310_create_product_variant_options_table',1),(27,'2021_04_03_063418_create_locations_table',1),(28,'2021_04_07_070019_create_page_options_table',1),(29,'2021_04_08_043538_create_blogs_table',1),(30,'2021_04_10_034521_create_product_coupons_table',1),(31,'2021_04_15_121323_create_blog_socials_table',1),(32,'2021_06_03_101323_create_admin_payment_settings',1),(33,'2021_06_25_041037_create_custom_massage_table',1),(34,'2021_07_07_084829_create_store_theme_settings_table',1),(35,'2021_11_17_115318_create_plan_requests_table',1),(36,'2022_01_10_052633_create__customers_table',1),(37,'2022_01_10_092146_create_purchased_products_table',1),(38,'2022_07_08_044639_create_store_payment_settings',1),(39,'2023_04_03_072342_create_pixel_fields_table',1),(40,'2023_05_25_062348_create_webhooks_table',1),(41,'2023_05_30_064523_create_express_checkout_table',1),(42,'2023_06_05_043450_create_landing_page_settings_table',1),(43,'2023_06_06_041522_create_template_table',1),(44,'2023_06_10_114031_create_join_us_table',1),(45,'2023_06_27_113741_create_languages_table',1),(46,'2023_12_11_110313_add_is_active_to_users_table',1),(47,'2024_01_27_032719_add_trial_plan_to_users_table',1),(48,'2024_01_27_032746_add_trial_to_plans_table',1),(49,'2024_01_29_101219_add_is_refund_to_plan_orders_table',1),(50,'2024_03_27_035105_create_custom_domain_requests_table',1),(51,'2024_04_02_041405_create_referral_settings_table',1),(52,'2024_04_02_042152_add_referral_code_to_users_table',1),(53,'2024_04_02_043233_create_referral_transactions_table',1),(54,'2024_04_02_043258_create_transaction_orders_table',1),(56,'2025_01_21_120927_create_testimonials_table',2),(57,'2026_01_11_120310_create_chassis_numbers_table',3),(58,'2026_03_01_151648_create_chassis_orders_table',4),(59,'2026_02_22_222940_add_time_and_location_to_chassis_numbers_table',5),(60,'2026_04_25_000001_add_tva_comment_to_chassis_orders',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `card_number` varchar(10) DEFAULT NULL,
  `card_exp_month` varchar(10) DEFAULT NULL,
  `card_exp_year` varchar(10) DEFAULT NULL,
  `user_address_id` varchar(191) DEFAULT NULL,
  `product_id` varchar(191) DEFAULT '0',
  `price` double DEFAULT NULL,
  `coupon` longtext DEFAULT NULL,
  `coupon_json` longtext DEFAULT NULL,
  `discount_price` varchar(191) DEFAULT NULL,
  `plan_name` varchar(191) DEFAULT NULL,
  `plan_id` varchar(191) DEFAULT NULL,
  `product` longtext DEFAULT NULL,
  `price_currency` varchar(10) NOT NULL,
  `txn_id` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `receipt` varchar(191) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `subscription_id` varchar(100) DEFAULT NULL,
  `payer_id` varchar(100) DEFAULT NULL,
  `shipping_data` longtext DEFAULT NULL,
  `customer_id` varchar(191) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'1757620797','walk-in-customer','','','','','','2',0,'','','0',NULL,NULL,'{\"1757620783\":{\"product_id\":2,\"product_name\":\"Honda 125i\",\"image\":\"download_1757619198.jpg\",\"quantity\":1,\"price\":\"50000\",\"id\":\"2\",\"downloadable_prodcut\":\"\",\"tax\":[],\"subtotal\":\"50000\",\"originalquantity\":213,\"variant_id\":0}}','MAD','','Point de point','approved','pending',NULL,'',1,NULL,NULL,'','',0,'2025-09-11 23:59:57','2025-09-11 23:59:57');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_options`
--

DROP TABLE IF EXISTS `page_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `enable_page_header` varchar(191) DEFAULT NULL,
  `enable_page_footer` varchar(191) DEFAULT NULL,
  `contents` longtext DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_options`
--

LOCK TABLES `page_options` WRITE;
/*!40000 ALTER TABLE `page_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Manage Dashboard','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(2,'Manage Store Analytics','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(3,'Manage User','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(4,'Create User','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(5,'Edit User','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(6,'Delete User','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(7,'Manage Role','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(8,'Create Role','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(9,'Delete Role','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(10,'Edit Role','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(11,'Manage Orders','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(12,'Show Orders','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(13,'Delete Orders','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(14,'Manage Products','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(15,'Create Products','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(16,'Delete Products','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(17,'Show Products','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(18,'Edit Products','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(19,'Create Variants','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(20,'Edit Variants','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(21,'Delete Variants','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(22,'Manage Product category','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(23,'Create Product category','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(24,'Delete Product category','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(25,'Edit Product category','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(26,'Manage Product Tax','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(27,'Create Product Tax','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(28,'Create Ratting','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(29,'Delete Product Tax','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(30,'Edit Product Tax','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(31,'Edit Ratting','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(32,'Delete Ratting','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(33,'Manage Product Coupan','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(34,'Create Product Coupan','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(35,'Show Product Coupan','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(36,'Delete Product Coupan','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(37,'Edit Product Coupan','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(38,'Manage Subscriber','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(39,'Create Subscriber','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(40,'Delete Subscriber','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(41,'Manage Location','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(42,'Create Location','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(43,'Delete Location','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(44,'Edit Location','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(45,'Manage Shipping','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(46,'Create Shipping','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(47,'Delete Shipping','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(48,'Edit Shipping','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(49,'Manage Custom Page','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(50,'Create Custom Page','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(51,'Delete Custom Page','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(52,'Edit Custom Page','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(53,'Manage Blog','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(54,'Create Blog','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(55,'Delete Blog','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(56,'Edit Blog','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(57,'Manage Customers','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(58,'Show Customers','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(59,'Manage Settings','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(60,'Manage Change Store','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(61,'Manage Language','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(62,'Create Language','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(63,'Delete Language','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(64,'Manage Store','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(65,'Create Store','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(66,'Delete Store','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(67,'Edit Store','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(68,'Reset Password','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(69,'Upgrade Plans','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(70,'Manage Coupans','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(71,'Create Coupans','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(72,'Delete Coupans','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(73,'Edit Coupans','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(74,'Show Coupans','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(75,'Manage Plans','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(76,'Create Plans','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(77,'Edit Plans','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(78,'Manage Email Template','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(79,'Edit Email Template','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(80,'Manage Plan Order','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(81,'Manage Plan Request','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(82,'Manage Pos','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(83,'Create Pos','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(84,'Manage Themes','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(85,'Edit Themes','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(86,'Manage Testimonial','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(87,'Create Testimonial','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(88,'Edit Testimonial','web','2025-09-11 21:18:46','2025-09-11 21:18:46'),(89,'Delete Testimonial','web','2025-09-11 21:18:46','2025-09-11 21:18:46');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pixel_fields`
--

DROP TABLE IF EXISTS `pixel_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pixel_fields` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `platform` varchar(191) DEFAULT NULL,
  `pixel_id` varchar(191) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pixel_fields`
--

LOCK TABLES `pixel_fields` WRITE;
/*!40000 ALTER TABLE `pixel_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `pixel_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plan_orders`
--

DROP TABLE IF EXISTS `plan_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plan_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `card_number` varchar(10) DEFAULT NULL,
  `card_exp_month` varchar(10) DEFAULT NULL,
  `card_exp_year` varchar(10) DEFAULT NULL,
  `plan_name` varchar(100) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `price` double DEFAULT NULL,
  `coupon` varchar(191) DEFAULT NULL,
  `coupon_json` text DEFAULT NULL,
  `discount_price` text DEFAULT NULL,
  `price_currency` varchar(10) NOT NULL,
  `txn_id` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `receipt` varchar(191) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `is_refund` int(11) NOT NULL DEFAULT 0,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `payment_type` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plan_orders_order_id_unique` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan_orders`
--

LOCK TABLES `plan_orders` WRITE;
/*!40000 ALTER TABLE `plan_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `plan_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plan_requests`
--

DROP TABLE IF EXISTS `plan_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plan_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `duration` varchar(20) NOT NULL DEFAULT 'monthly',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan_requests`
--

LOCK TABLES `plan_requests` WRITE;
/*!40000 ALTER TABLE `plan_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `plan_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` decimal(30,2) DEFAULT 0.00,
  `duration` varchar(100) DEFAULT NULL,
  `max_stores` int(11) NOT NULL DEFAULT 0,
  `max_products` int(11) NOT NULL DEFAULT 0,
  `max_users` int(11) NOT NULL,
  `storage_limit` double NOT NULL,
  `enable_custdomain` varchar(191) NOT NULL DEFAULT 'off',
  `additional_page` varchar(191) DEFAULT NULL,
  `blog` varchar(191) DEFAULT NULL,
  `shipping_method` varchar(191) DEFAULT NULL,
  `trial` varchar(191) NOT NULL DEFAULT 'off',
  `trial_days` varchar(191) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `enable_chatgpt` varchar(191) NOT NULL DEFAULT 'off',
  `enable_custsubdomain` varchar(191) NOT NULL DEFAULT 'off',
  `image` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `pwa_store` varchar(191) NOT NULL DEFAULT 'off',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plans_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (1,'Free Plan',0.00,'Lifetime',1,5,5,1024,'on','on','on','on','off',NULL,1,'on','on','free_plan.png','For companies that need a robust full-featured time tracker.','on','2025-09-11 21:18:47','2026-04-17 18:30:21');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `categorie_img` varchar(191) DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `brand_id` bigint(20) unsigned DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_parent_category` (`parent_id`),
  KEY `fk_brand_category` (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,NULL,'C50','moteur.ma-docker-c50-235281__1758359835.jpg',1,7,2,'2025-09-20 13:17:15','2025-09-20 13:17:15'),(2,NULL,'DOCKER C50','moteur.ma-docker-c50-235281__1758979368.jpg',1,7,2,'2025-09-27 17:22:48','2025-09-27 17:22:48'),(3,NULL,'gama',NULL,0,7,0,'2026-01-11 22:08:18','2026-01-11 22:08:18'),(4,NULL,'r12',NULL,0,7,0,'2026-02-21 05:05:59','2026-02-21 05:05:59'),(5,NULL,'33',NULL,0,1,0,'2026-02-21 05:07:27','2026-02-21 05:07:27'),(6,NULL,'Docker C50 New Rim 23 BAT',NULL,0,7,0,'2026-02-21 18:01:02','2026-02-21 18:01:02'),(7,NULL,'Docker C50 New Rim 23 BAT',NULL,0,7,0,'2026-02-21 18:01:45','2026-02-21 18:01:45'),(8,NULL,'Docker C50 New Rim 23 BAT',NULL,0,7,0,'2026-02-21 18:01:45','2026-02-21 18:01:45'),(9,NULL,'Docker C 50 New Rim 22 CH',NULL,0,7,0,'2026-02-21 18:23:37','2026-02-21 18:23:37'),(10,NULL,'Docker C50 FREIN  DISQUE 23-BAT',NULL,0,7,0,'2026-02-21 19:24:29','2026-02-21 19:24:29'),(11,NULL,'Docker Scooter',NULL,0,7,0,'2026-02-21 19:51:50','2026-02-21 19:51:50'),(12,NULL,'DOCKER TANK',NULL,0,7,0,'2026-02-21 20:07:04','2026-02-21 20:07:04'),(13,NULL,'Docker Triporteur',NULL,0,7,0,'2026-02-21 21:27:51','2026-02-21 21:27:51'),(14,NULL,'Docker C50 FIRE',NULL,0,7,0,'2026-02-21 21:31:58','2026-02-21 21:31:58'),(15,NULL,'Becane Ribeiro 33 AC',NULL,0,1,0,'2026-02-21 21:34:59','2026-02-21 21:34:59'),(16,NULL,'BECANE SCOOTER',NULL,0,1,0,'2026-02-21 21:35:50','2026-02-21 21:35:50'),(17,NULL,'BECANE 29',NULL,0,1,0,'2026-02-22 04:26:47','2026-02-22 04:26:47'),(18,NULL,'BECANE SPRING X',NULL,0,1,0,'2026-02-22 04:27:36','2026-02-22 04:27:36'),(19,NULL,'BECANE NYMAR',NULL,0,1,0,'2026-02-22 04:28:05','2026-02-22 04:28:05'),(20,NULL,'BECANE SUPER CUB 300',NULL,0,1,0,'2026-02-22 04:30:13','2026-02-22 04:30:13'),(21,NULL,'BECANE SUPER CUB 127CC',NULL,0,1,0,'2026-02-22 04:30:28','2026-02-22 04:30:28'),(22,NULL,'BECANE NEO CUB',NULL,0,1,0,'2026-02-22 04:30:55','2026-02-22 04:30:55'),(23,NULL,'test',NULL,0,1,0,'2026-04-18 19:07:21','2026-04-18 19:07:21'),(24,NULL,'test1111',NULL,0,1,0,'2026-04-25 14:33:03','2026-04-25 14:33:03');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_coupons`
--

DROP TABLE IF EXISTS `product_coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_coupons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `enable_flat` varchar(191) DEFAULT 'off',
  `discount` double NOT NULL DEFAULT 0,
  `flat_discount` double DEFAULT 0,
  `limit` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_coupons`
--

LOCK TABLES `product_coupons` WRITE;
/*!40000 ALTER TABLE `product_coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_images` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_taxes`
--

DROP TABLE IF EXISTS `product_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_taxes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `rate` double NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_taxes`
--

LOCK TABLES `product_taxes` WRITE;
/*!40000 ALTER TABLE `product_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variant_options`
--

DROP TABLE IF EXISTS `product_variant_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_variant_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(191) DEFAULT NULL,
  `price` double DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variant_options`
--

LOCK TABLES `product_variant_options` WRITE;
/*!40000 ALTER TABLE `product_variant_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_variant_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variants`
--

DROP TABLE IF EXISTS `product_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_variants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variants`
--

LOCK TABLES `product_variants` WRITE;
/*!40000 ALTER TABLE `product_variants` DISABLE KEYS */;
INSERT INTO `product_variants` VALUES (3,2,'C50 DIGITAL',29258,10,'WhatsApp Image 2025-09-27 at 14.26.00_ce4d9776_1758979587.jpg','2025-09-27 17:26:27','2026-04-25 13:02:40'),(4,2,'C50 NEW-RIM 23 BT',16028,10,'WhatsApp Image 2025-09-27 at 14.32.18_7a471241_1758979983.jpg','2025-09-27 17:33:03','2026-04-25 13:02:40'),(5,2,'DOCKER C50 FDM 23 BT /BLEU',43875,10,'WhatsApp Image 2025-09-27 at 15.17.31_a21a01e5_1758982759.jpg','2025-09-27 18:09:53','2026-04-25 13:02:40'),(6,2,'C50 New Rim CH',44588,10,'Capture d\'├⌐cran 2024-02-15 121156_1767522964.png','2026-01-04 15:36:04','2026-04-25 13:02:40'),(7,1,'c50 chladda',38435,0,NULL,'2026-01-11 21:07:52','2026-04-25 13:02:40'),(8,1,'c50 DISK BLACK',49711,1,NULL,'2026-01-11 22:08:50','2026-04-25 13:02:40'),(9,1,'C50 NEW-RIM 23 BT NOIR',37750,20,NULL,'2026-02-20 21:52:04','2026-04-25 13:02:40'),(10,1,'C50 DIGITAL NOIR',32864,3,NULL,'2026-02-21 05:06:33','2026-04-25 13:02:40'),(11,6,'Bleu BAT',70246,10,NULL,'2026-02-21 18:04:29','2026-04-25 13:02:40'),(12,9,'C50 Bleu 22 CH',60739,3,NULL,'2026-02-21 18:36:35','2026-04-25 13:02:40'),(13,9,'C50 Gold 22 CH',34725,2,NULL,'2026-02-21 18:39:32','2026-04-25 13:02:40'),(14,9,'C50 Rouge  22 CH',43734,6,NULL,'2026-02-21 18:44:03','2026-04-25 13:02:40'),(15,10,'C50 FDM BRONZE 23-BAT',20916,4,NULL,'2026-02-21 19:26:40','2026-04-25 13:02:40'),(16,10,'C50 FDM PISTACH 23-BAT',62038,3,NULL,'2026-02-21 19:31:09','2026-04-25 13:02:40'),(17,10,'C50 FDM NARDO 23-BAT',40625,1,NULL,'2026-02-21 19:33:48','2026-04-25 13:02:40'),(18,10,'C50 FDM BLEU 23-BAT',55285,4,NULL,'2026-02-21 19:35:07','2026-04-25 13:02:40'),(19,6,'C50 NOIR-BLEU STIKER 2025',72263,5,NULL,'2026-02-21 19:47:21','2026-04-25 13:02:40'),(20,11,'Docker CRUZER',20417,2,NULL,'2026-02-21 19:52:58','2026-04-25 13:02:40'),(21,12,'DOCKER TANK-50 Rouge/Noir',59337,3,NULL,'2026-02-21 20:07:59','2026-04-25 13:02:40'),(22,13,'Docker Triporteur DR 2-Bleu',76319,1,NULL,'2026-02-21 21:28:28','2026-04-25 13:02:40'),(23,14,'C50 FIRE BLEU-CH 22',40770,1,NULL,'2026-02-21 21:33:12','2026-04-25 13:02:40'),(24,16,'BECANE VALENTI',38288,1,NULL,'2026-02-21 21:36:40','2026-04-25 13:02:40'),(25,16,'BECANE MATTEO',66652,1,NULL,'2026-02-21 21:37:07','2026-04-25 13:02:40'),(26,16,'BECANE SUPER FLORENCE',58313,3,NULL,'2026-02-21 21:38:31','2026-04-25 13:02:40'),(27,16,'BECANE VESTA',42114,2,NULL,'2026-02-21 21:39:31','2026-04-25 13:02:40'),(28,16,'BECANE TORINO',66757,1,NULL,'2026-02-21 21:41:25','2026-04-25 13:02:40'),(29,16,'BECANE MIRO',18871,2,NULL,'2026-02-21 21:42:49','2026-04-25 13:02:40'),(30,16,'BECANE SH',72155,1,NULL,'2026-02-21 21:43:33','2026-04-25 13:02:40'),(31,16,'BECANE R9',69941,3,NULL,'2026-02-21 21:43:58','2026-04-25 13:02:40'),(32,23,'test',65320,8,NULL,'2026-04-18 19:07:37','2026-04-25 16:34:48'),(33,5,'test',0,20,NULL,'2026-04-25 14:12:36','2026-04-25 15:51:10'),(34,23,'test222222',0,2,NULL,'2026-04-25 14:22:19','2026-04-25 14:22:19'),(35,24,'testino',5000,-2,NULL,'2026-04-25 14:33:30','2026-04-25 15:52:46');
/*!40000 ALTER TABLE `product_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `variant_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `SKU` varchar(191) NOT NULL,
  `price` double DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT 1,
  `product_display` varchar(10) NOT NULL DEFAULT 'on',
  PRIMARY KEY (`id`),
  UNIQUE KEY `SKU` (`SKU`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (2,2,'C50 CHLADA GREEN','12321HDSAHAS',12000,'Screenshot 2025-09-20 102029_1758360078.png','2025-09-20 13:21:18','2025-09-20 13:21:18',1,'on'),(3,3,'C50 DIGITAL','L1TXCBLY2S1827420',9200,'WhatsApp Image 2025-09-27 at 14.26.00_ce4d9776_1758979757.jpg','2025-09-27 17:29:17','2025-09-27 17:29:17',1,'on'),(4,3,'C50 DIGITAL NOIR','L23SADNNASDNASND',9200,'WhatsApp Image 2025-09-27 at 14.26.00_ce4d9776_1758979796.jpg','2025-09-27 17:29:56','2025-09-27 17:30:23',1,'on'),(5,4,'C50 NEW-RIM 23 BT NOIR','LOSADO123AMDSAD12',9500,'WhatsApp Image 2025-09-27 at 14.32.18_7a471241_1758980040.jpg','2025-09-27 17:34:00','2025-09-27 17:34:00',1,'on'),(6,4,'C50 NEW-RIM 23 BT BLEU','123SAD21HDSAHAS',9500,'WhatsApp Image 2025-09-27 at 14.32.18_7a471241_1758980068.jpg','2025-09-27 17:34:28','2025-09-27 17:34:28',1,'on'),(7,5,'DOCKER C50 FDM 23 BT /BLEU','LB405',10500,'WhatsApp Image 2025-09-27 at 15.02.30_0a9c5714_1758982353.jpg','2025-09-27 18:12:33','2025-09-27 18:12:33',1,'on');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchased_products`
--

DROP TABLE IF EXISTS `purchased_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchased_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchased_products`
--

LOCK TABLES `purchased_products` WRITE;
/*!40000 ALTER TABLE `purchased_products` DISABLE KEYS */;
INSERT INTO `purchased_products` VALUES (1,0,2,1,'2025-09-11 23:59:57','2025-09-11 23:59:57');
/*!40000 ALTER TABLE `purchased_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rattings`
--

DROP TABLE IF EXISTS `rattings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rattings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) NOT NULL,
  `product_id` varchar(191) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `title` varchar(191) DEFAULT NULL,
  `rating_view` varchar(191) NOT NULL DEFAULT 'on',
  `ratting` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rattings`
--

LOCK TABLES `rattings` WRITE;
/*!40000 ALTER TABLE `rattings` DISABLE KEYS */;
/*!40000 ALTER TABLE `rattings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referral_settings`
--

DROP TABLE IF EXISTS `referral_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referral_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `percentage` int(11) NOT NULL,
  `minimum_threshold_amount` int(11) NOT NULL,
  `is_enable` int(11) NOT NULL DEFAULT 0,
  `guideline` longtext NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referral_settings`
--

LOCK TABLES `referral_settings` WRITE;
/*!40000 ALTER TABLE `referral_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `referral_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referral_transaction_orders`
--

DROP TABLE IF EXISTS `referral_transaction_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referral_transaction_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `req_amount` decimal(30,2) NOT NULL DEFAULT 0.00,
  `req_user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referral_transaction_orders`
--

LOCK TABLES `referral_transaction_orders` WRITE;
/*!40000 ALTER TABLE `referral_transaction_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `referral_transaction_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referral_transactions`
--

DROP TABLE IF EXISTS `referral_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referral_transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `plan_price` decimal(30,2) NOT NULL DEFAULT 0.00,
  `commission` int(11) NOT NULL,
  `referral_code` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referral_transactions`
--

LOCK TABLES `referral_transactions` WRITE;
/*!40000 ALTER TABLE `referral_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `referral_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(1,2),(1,5),(2,2),(3,2),(3,5),(4,2),(4,5),(5,2),(5,5),(6,2),(6,5),(7,2),(8,2),(9,2),(10,2),(11,2),(11,5),(12,2),(13,2),(14,2),(14,5),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(34,2),(35,2),(36,2),(37,2),(38,2),(39,2),(40,2),(41,2),(41,5),(42,2),(43,2),(44,2),(45,2),(46,2),(47,2),(48,2),(49,2),(50,2),(51,2),(52,2),(53,2),(54,2),(55,2),(56,2),(57,2),(58,2),(59,1),(59,2),(60,2),(61,1),(62,1),(63,1),(64,1),(64,2),(65,1),(65,2),(66,1),(67,1),(68,1),(68,2),(69,1),(70,1),(71,1),(72,1),(73,1),(74,1),(75,1),(75,2),(76,1),(77,1),(78,1),(79,1),(80,1),(81,1),(82,2),(83,2),(84,2),(85,2),(86,2),(87,2),(88,2),(89,2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `store_id` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super admin','web',0,NULL,'2025-09-11 21:18:46','2025-09-11 21:18:46'),(2,'Owner','web',1,NULL,'2025-09-11 21:18:46','2025-09-11 21:18:46'),(3,'test','web',2,'1','2026-04-24 18:46:42','2026-04-24 18:46:42'),(4,'test111','web',2,'1','2026-04-24 18:49:55','2026-04-24 18:49:55'),(5,'TEST reda','web',2,'1','2026-04-24 18:54:22','2026-04-24 18:54:22');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `value` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_name_store_id_created_by_unique` (`name`,`store_id`,`created_by`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'local_storage_validation','jpg,jpeg,png,xlsx,xls,csv,pdf',1,0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(2,'wasabi_storage_validation','jpg,jpeg,png,xlsx,xls,csv,pdf',1,0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(3,'s3_storage_validation','jpg,jpeg,png,xlsx,xls,csv,pdf',1,0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(4,'local_storage_max_upload_size','2048000',1,0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(5,'wasabi_max_upload_size','2048000',1,0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(6,'s3_max_upload_size','2048000',1,0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(7,'storage_setting','local',1,0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(8,'title_text',NULL,1,0,NULL,NULL),(9,'footer_text',NULL,1,0,NULL,NULL),(10,'default_language','en',1,0,NULL,NULL),(11,'currency_symbol',NULL,1,0,NULL,NULL),(12,'currency',NULL,1,0,NULL,NULL),(13,'display_landing_page','off',1,0,NULL,NULL),(14,'signup_button','on',1,0,NULL,NULL),(15,'email_verification','on',1,0,NULL,NULL),(16,'color','#ff6500',1,0,NULL,NULL),(17,'color_flag','true',1,0,NULL,NULL),(18,'cust_theme_bg','on',1,0,NULL,NULL),(19,'cust_darklayout','off',1,0,NULL,NULL),(20,'SITE_RTL','off',1,0,NULL,NULL),(21,'SITE_RTL','off',2,1,NULL,NULL),(22,'site_date_format','M j, Y',2,1,NULL,NULL),(23,'site_time_format','g:i A',2,1,NULL,NULL),(24,'timezone','Africa/Casablanca',2,1,NULL,NULL),(25,'color','#ff6500',2,1,NULL,NULL),(26,'custom_color','#ff6500',2,1,NULL,NULL),(27,'color_flag','true',2,1,NULL,NULL),(28,'cust_theme_bg','on',2,1,NULL,NULL),(29,'cust_darklayout','off',2,1,NULL,NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shippings`
--

DROP TABLE IF EXISTS `shippings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shippings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `price` varchar(191) NOT NULL,
  `location_id` varchar(191) NOT NULL DEFAULT '0',
  `store_id` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shippings`
--

LOCK TABLES `shippings` WRITE;
/*!40000 ALTER TABLE `shippings` DISABLE KEYS */;
/*!40000 ALTER TABLE `shippings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_payment_settings`
--

DROP TABLE IF EXISTS `store_payment_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `store_payment_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `value` varchar(191) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `store_payment_settings_name_store_id_created_by_unique` (`name`,`store_id`,`created_by`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_payment_settings`
--

LOCK TABLES `store_payment_settings` WRITE;
/*!40000 ALTER TABLE `store_payment_settings` DISABLE KEYS */;
INSERT INTO `store_payment_settings` VALUES (1,'is_stripe_enabled','off',1,2,NULL,NULL),(2,'is_paypal_enabled','off',1,2,NULL,NULL),(3,'is_paystack_enabled','off',1,2,NULL,NULL),(4,'is_flutterwave_enabled','off',1,2,NULL,NULL),(5,'is_razorpay_enabled','off',1,2,NULL,NULL),(6,'is_paytm_enabled','off',1,2,NULL,NULL),(7,'is_mercado_enabled','off',1,2,NULL,NULL),(8,'is_mollie_enabled','off',1,2,NULL,NULL),(9,'is_skrill_enabled','off',1,2,NULL,NULL),(10,'is_coingate_enabled','off',1,2,NULL,NULL),(11,'is_paymentwall_enabled','off',1,2,NULL,NULL),(12,'enable_telegram','off',1,2,NULL,NULL),(13,'is_toyyibpay_enabled','off',1,2,NULL,NULL),(14,'is_payfast_enabled','off',1,2,NULL,NULL),(15,'is_iyzipay_enabled','off',1,2,NULL,NULL),(16,'is_paytab_enabled','off',1,2,NULL,NULL),(17,'is_benefit_enabled','off',1,2,NULL,NULL),(18,'is_cashfree_enabled','off',1,2,NULL,NULL),(19,'is_aamarpay_enabled','off',1,2,NULL,NULL),(20,'is_paytr_enabled','off',1,2,NULL,NULL),(21,'is_yookassa_enabled','off',1,2,NULL,NULL),(22,'is_midtrans_enabled','off',1,2,NULL,NULL),(23,'is_xendit_enabled','off',1,2,NULL,NULL),(24,'is_nepalste_enabled','off',1,2,NULL,NULL),(25,'is_paiementpro_enabled','off',1,2,NULL,NULL),(26,'is_fedapay_enabled','off',1,2,NULL,NULL),(27,'is_payhere_enabled','off',1,2,NULL,NULL),(28,'is_cinetpay_enabled','off',1,2,NULL,NULL),(29,'is_tap_enabled','off',1,2,NULL,NULL),(30,'is_authorizenet_enabled','off',1,2,NULL,NULL),(31,'is_khalti_enabled','off',1,2,NULL,NULL),(32,'is_ozow_enabled','off',1,2,NULL,NULL);
/*!40000 ALTER TABLE `store_payment_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_theme_settings`
--

DROP TABLE IF EXISTS `store_theme_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `store_theme_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL COMMENT 'name/pagename',
  `value` text DEFAULT NULL COMMENT 'value/json_value',
  `type` varchar(191) DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `theme_name` varchar(191) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_theme_settings`
--

LOCK TABLES `store_theme_settings` WRITE;
/*!40000 ALTER TABLE `store_theme_settings` DISABLE KEYS */;
INSERT INTO `store_theme_settings` VALUES (1,'dashboard','{\"0\":{\"section_enable\":\"off\",\"section_name\":\"Home-Header\",\"section_slug\":\"homepage-header\",\"array_type\":\"inner-list\",\"loop_number\":\"1\",\"inner-list\":[{\"field_name\":\"Title\",\"field_slug\":\"homepage-header-title\",\"field_help_text\":\"Please add title text here\",\"field_default_text\":\"Style Sur Deux Roues: Accessoires Sign\\u00e9s Mobi Nardo\",\"field_type\":\"text\"},{\"field_name\":\"Sub text\",\"field_slug\":\"homepage-sub-text\",\"field_help_text\":\"Please add sub text here\",\"field_default_text\":\"Mobi Nardo propose une large gamme de v\\u00e9los, gadgets et accessoires de mobilit\\u00e9 pour toute la famille. Qualit\\u00e9, choix et service client exceptionnel sont au rendez-vous pour des d\\u00e9placements en toute s\\u00e9curit\\u00e9 et style.\",\"field_type\":\"text area\"},{\"field_name\":\"Button\",\"field_slug\":\"homepage-header-button\",\"field_help_text\":\"Please add button text here\",\"field_default_text\":\"Shop Now\",\"field_type\":\"text\"},{\"field_name\":\"Background Image\",\"field_slug\":\"homepage-header-bg-image\",\"field_help_text\":null,\"field_default_text\":\"theme10\\/header\\/background-22509111757612282.png\",\"field_type\":\"photo upload\",\"field_prev_text\":\"theme10\\/header\\/background-22509111757612282.png\"},{\"field_name\":\"Right Background Image\",\"field_slug\":\"homepage-header-right-bg-image\",\"field_help_text\":null,\"field_default_text\":\"theme10\\/header\\/cta_image2509111757612282.png\",\"field_type\":\"photo upload\",\"field_prev_text\":\"theme10\\/header\\/cta_image2509111757612282.png\"}]},\"7\":{\"section_name\":\"Home-Email-Subscriber\",\"section_slug\":\"homepage-email-subscriber\",\"array_type\":\"inner-list\",\"loop_number\":\"1\",\"section_enable\":\"off\",\"inner-list\":[{\"field_name\":\"Subscriber Title\",\"field_slug\":\"homepage-subscriber-title\",\"field_help_text\":\"Please add title here\",\"field_default_text\":\"Subscribe to us and stay up to date with the information\",\"field_type\":\"text area\"},{\"field_name\":\"Button Text\",\"field_slug\":\"homepage-subscriber-button\",\"field_help_text\":\"Please add button text here\",\"field_default_text\":\"Subscribe\",\"field_type\":\"text\"}]},\"3\":{\"section_name\":\"Home-Categories\",\"section_slug\":\"homepage-categories\",\"array_type\":\"inner-list\",\"loop_number\":\"1\",\"section_enable\":\"off\",\"inner-list\":[{\"field_name\":\"Title\",\"field_slug\":\"homepage-categories-title\",\"field_help_text\":\"Please add title text here\",\"field_default_text\":\"Categories\",\"field_type\":\"text\"},{\"field_name\":\"Description\",\"field_slug\":\"homepage-categories-description\",\"field_help_text\":\"Please add description text here\",\"field_default_text\":\"Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.\",\"field_type\":\"text area\"},{\"field_name\":\"Button\",\"field_slug\":\"homepage-categories-button\",\"field_help_text\":\"Please add button text here\",\"field_default_text\":\"Go To Shop\",\"field_type\":\"text\"}]},\"5\":{\"section_enable\":\"off\",\"section_name\":\"Home-Testimonial\",\"section_slug\":\"homepage-testimonial\",\"array_type\":\"inner-list\",\"loop_number\":\"1\",\"inner-list\":[{\"field_name\":\"Main Heading\",\"field_slug\":\"homepage-testimonial-heading\",\"field_help_text\":\"Please add heading text here\",\"field_default_text\":\"Testimonials\",\"field_type\":\"text\"}]},\"6\":{\"section_name\":\"Home-Brand-Logo\",\"section_slug\":\"homepage-brand-logo\",\"array_type\":\"inner-list\",\"loop_number\":\"1\",\"section_enable\":\"off\",\"inner-list\":[{\"field_name\":\"Brand Logo\",\"field_slug\":\"homepage-brand-logo-input\",\"field_help_text\":null,\"field_default_text\":\"theme10\\/footer\\/brand_logo.jpg\",\"field_type\":\"multi file upload\"},{\"field_name\":\"Title\",\"field_slug\":\"homepage-header-title\",\"field_help_text\":\"Please add title text here\",\"field_default_text\":\"Meet our social media\",\"field_type\":\"text\"},{\"field_name\":\"Sub text\",\"field_slug\":\"homepage-sub-text\",\"field_help_text\":\"Please add sub text here\",\"field_default_text\":\"Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.\",\"field_type\":\"text area\"}]},\"1\":{\"section_name\":\"Latest-Category\",\"section_slug\":\"homepage-latest-category\",\"array_type\":\"inner-list\",\"loop_number\":\"1\",\"section_enable\":\"on\",\"inner-list\":[{\"field_name\":\"Title\",\"field_slug\":\"homepage-header-title\",\"field_help_text\":\"Please add title text here\",\"field_default_text\":\"Check The Latest Categories\",\"field_type\":\"text\"},{\"field_name\":\"Sub text\",\"field_slug\":\"homepage-sub-text\",\"field_help_text\":\"Please add sub text here\",\"field_default_text\":\"Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.\",\"field_type\":\"text area\"},{\"field_name\":\"Button\",\"field_slug\":\"homepage-header-button\",\"field_help_text\":\"Please add button text here\",\"field_default_text\":\"GO TO SHOP\",\"field_type\":\"text\"}]},\"2\":{\"section_name\":\"Latest-Products\",\"section_slug\":\"homepage-latest-products\",\"array_type\":\"inner-list\",\"loop_number\":\"1\",\"section_enable\":\"off\",\"inner-list\":[{\"field_name\":\"Title\",\"field_slug\":\"homepage-header-title\",\"field_help_text\":\"Please add title text here\",\"field_default_text\":\"Introducing Our Latest Arrivals\",\"field_type\":\"text\"},{\"field_name\":\"Sub text\",\"field_slug\":\"homepage-sub-text\",\"field_help_text\":\"Please add sub text here\",\"field_default_text\":\"Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.\",\"field_type\":\"text area\"},{\"field_name\":\"Button\",\"field_slug\":\"homepage-header-button\",\"field_help_text\":\"Please add button text here\",\"field_default_text\":\"Go To Shop\",\"field_type\":\"text\"},{\"field_name\":\"Background Text\",\"field_slug\":\"homepage-category-bg-text\",\"field_help_text\":\"Please add background text here\",\"field_default_text\":\"Trusted forever\",\"field_type\":\"text\"},{\"field_name\":\"Category Background Image\",\"field_slug\":\"homepage-category-bg-image\",\"field_help_text\":null,\"field_default_text\":\"theme10\\/header\\/latest_pro_backimg.png\",\"field_type\":\"photo upload\",\"field_prev_text\":\"theme10\\/header\\/latest_pro_backimg.png\"}]},\"4\":{\"section_name\":\"Top-Purchased\",\"section_slug\":\"banner-image\",\"array_type\":\"inner-list\",\"loop_number\":\"1\",\"section_enable\":\"off\",\"inner-list\":[{\"field_name\":\"Title\",\"field_slug\":\"homepage-header-title\",\"field_help_text\":\"Please add title text here\",\"field_default_text\":\"Most Purchased Product\",\"field_type\":\"text\"},{\"field_name\":\"Sub text\",\"field_slug\":\"homepage-sub-text\",\"field_help_text\":\"Please add sub text here\",\"field_default_text\":\"There is only that moment and the incredible certainty that everything under the sun has been written by one hand only.\",\"field_type\":\"text area\"},{\"field_name\":\"Button Text\",\"field_slug\":\"homepage-subscriber-button\",\"field_help_text\":\"Please add button text here\",\"field_default_text\":\"Go To Shop\",\"field_type\":\"text\"},{\"field_name\":\"Background Image\",\"field_slug\":\"homepage-purchased-bg-image\",\"field_help_text\":null,\"field_default_text\":\"theme10\\/header\\/purchased-banner.png\",\"field_type\":\"photo upload\",\"field_prev_text\":\"theme10\\/header\\/purchased-banner.png\"}]},\"8\":{\"section_enable\":\"off\",\"section_name\":\"Home-Footer-1\",\"section_slug\":\"homepage-footer-1\",\"array_type\":\"inner-list\",\"loop_number\":\"1\",\"inner-list\":[{\"field_name\":\"Footer Logo\",\"field_slug\":\"homepage-footer-logo\",\"field_help_text\":null,\"field_default_text\":\"theme10\\/header\\/footer10.png\",\"field_type\":\"photo upload\",\"field_prev_text\":\"theme10\\/header\\/footer10.png\"},{\"field_name\":\"Footer Description\",\"field_slug\":\"footer-description\",\"field_help_text\":\"Please add sub text here\",\"field_default_text\":\"Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.\",\"field_type\":\"text area\"}]},\"9\":{\"section_name\":\"Home-Footer-1\",\"section_slug\":\"homepage-footer-1\",\"array_type\":\"inner-list\",\"loop_number\":\"1\",\"inner-list\":[{\"field_name\":\"Enable Quick Link 1\",\"field_slug\":\"homepage-quick-link-enable\",\"field_help_text\":null,\"field_default_text\":\"off\",\"field_type\":\"checkbox\"},{\"field_name\":\"Footer Quick Link Header Name 1\",\"field_slug\":\"homepage-footer-header-quick-link-name-1\",\"field_help_text\":null,\"field_default_text\":\"STORE\",\"field_type\":\"text\"}]},\"10\":{\"section_name\":\"Home-Footer-1\",\"section_slug\":\"homepage-footer-1\",\"array_type\":\"multi-inner-list\",\"loop_number\":\"4\",\"inner-list\":[{\"field_name\":\"Quick Link\",\"field_slug\":\"homepage-header-quick-link-name-1\",\"field_help_text\":\"Please add link name here\",\"field_default_text\":\"Accessories\",\"field_type\":\"text\"},{\"field_name\":\"Quick Link Url\",\"field_slug\":\"homepage-header-quick-link-1\",\"field_help_text\":\"Please add link here\",\"field_default_text\":\"#\",\"field_type\":\"text\"}],\"homepage-header-quick-link-name-1\":[\"Accessories\",\"Accessories\",\"Accessories\",\"Accessories\"],\"homepage-header-quick-link-1\":[\"#\",\"#\",\"#\",\"#\"]},\"11\":{\"section_name\":\"Home-Footer-1\",\"section_slug\":\"homepage-footer-1\",\"array_type\":\"inner-list\",\"loop_number\":\"1\",\"inner-list\":[{\"field_name\":\"Enable Quick Link 2\",\"field_slug\":\"homepage-quick-link-enable\",\"field_help_text\":null,\"field_default_text\":\"off\",\"field_type\":\"checkbox\"},{\"field_name\":\"Footer Quick Link Header Name 2\",\"field_slug\":\"homepage-footer-header-quick-link-name-2\",\"field_help_text\":null,\"field_default_text\":\"ABOUT\",\"field_type\":\"text\"}]},\"12\":{\"section_name\":\"Home-Footer-1\",\"section_slug\":\"homepage-footer-1\",\"array_type\":\"multi-inner-list\",\"loop_number\":\"4\",\"inner-list\":[{\"field_name\":\"Quick Link\",\"field_slug\":\"homepage-header-quick-link-name-2\",\"field_help_text\":\"Please add link name here\",\"field_default_text\":\"About us\",\"field_type\":\"text\"},{\"field_name\":\"Quick Link Url\",\"field_slug\":\"homepage-header-quick-link-2\",\"field_help_text\":\"Please add link here\",\"field_default_text\":\"#\",\"field_type\":\"text\"}],\"homepage-header-quick-link-name-2\":[\"About us\",\"About us\",\"About us\",\"About us\"],\"homepage-header-quick-link-2\":[\"#\",\"#\",\"#\",\"#\"]},\"13\":{\"section_name\":\"Home-Footer-1\",\"section_slug\":\"homepage-footer-1\",\"array_type\":\"inner-list\",\"loop_number\":\"1\",\"inner-list\":[{\"field_name\":\"Enable Quick Link 3\",\"field_slug\":\"homepage-quick-link-enable\",\"field_help_text\":null,\"field_default_text\":\"off\",\"field_type\":\"checkbox\"},{\"field_name\":\"Footer Quick Link Header Name 3\",\"field_slug\":\"homepage-footer-header-quick-link-name-3\",\"field_help_text\":null,\"field_default_text\":\"ORDERS\",\"field_type\":\"text\"}]},\"14\":{\"section_name\":\"Home-Footer-1\",\"section_slug\":\"homepage-footer-1\",\"array_type\":\"multi-inner-list\",\"loop_number\":\"4\",\"inner-list\":[{\"field_name\":\"Quick Link\",\"field_slug\":\"homepage-header-quick-link-name-3\",\"field_help_text\":\"Please add link name here\",\"field_default_text\":\"Status\",\"field_type\":\"text\"},{\"field_name\":\"Quick Link Url\",\"field_slug\":\"homepage-header-quick-link-3\",\"field_help_text\":\"Please add link here\",\"field_default_text\":\"#\",\"field_type\":\"text\"}],\"homepage-header-quick-link-name-3\":[\"Status\",\"Status\",\"Status\",\"Status\"],\"homepage-header-quick-link-3\":[\"#\",\"#\",\"#\",\"#\"]},\"15\":{\"section_enable\":\"on\",\"section_name\":\"Home-Footer-2\",\"section_slug\":\"home-footer-2\",\"array_type\":\"inner-list\",\"loop_number\":\"1\",\"inner-list\":[{\"field_name\":\"Footer Note\",\"field_slug\":\"homepage-footer-2-note\",\"field_help_text\":\"Please add footer note here\",\"field_default_text\":null,\"field_type\":\"text\"}]},\"16\":{\"section_name\":\"Home-Footer-2\",\"section_slug\":\"home-footer-2\",\"array_type\":\"multi-inner-list\",\"loop_number\":\"4\",\"inner-list\":[{\"field_name\":\"Social Link Icon\",\"field_slug\":\"homepage-footer-2-social-icon\",\"field_help_text\":\"Please click here to find font... fontawesome.com\",\"field_default_text\":\"<i class=\'fab fa-youtube\'><\\/i>\",\"field_type\":\"text\"},{\"field_name\":\"Social Link\",\"field_slug\":\"homepage-footer-2-social-link\",\"field_help_text\":\"Please add social link here\",\"field_default_text\":\"https:\\/\\/www.youtube.com\\/\",\"field_type\":\"text\"}],\"homepage-footer-2-social-icon\":[\"<i class=\'fab fa-youtube\'><\\/i>\",\"<i class=\'fab fa-youtube\'><\\/i>\",\"<i class=\'fab fa-youtube\'><\\/i>\",\"<i class=\'fab fa-youtube\'><\\/i>\"],\"homepage-footer-2-social-link\":[\"https:\\/\\/www.youtube.com\\/\",\"https:\\/\\/www.youtube.com\\/\",\"https:\\/\\/www.youtube.com\\/\",\"https:\\/\\/www.youtube.com\\/\"]},\"17\":{\"section_name\":\"Home-Footer-2\",\"section_slug\":\"home-footer-2\",\"array_type\":\"inner-list\",\"loop_number\":\"1\",\"inner-list\":[{\"field_name\":\"Store Custom JS\",\"field_slug\":\"homepage-footer-2-custom-js\",\"field_help_text\":\"Please add custom js here\",\"field_default_text\":\"console.log(\'Hello World!\');\",\"field_type\":\"text area\"}]}}',NULL,1,'theme10',2,'2025-09-11 21:38:02','2025-09-12 00:16:58'),(2,'enable_top_bar','off',NULL,1,'theme10',2,'2025-09-11 21:38:02','2025-09-11 23:26:41'),(3,'top_bar_title','FREE SHIPPING world wide for all orders over $199',NULL,1,'theme10',2,'2025-09-11 21:38:02','2025-09-11 21:38:02'),(4,'top_bar_number','(212) 308-1220',NULL,1,'theme10',2,'2025-09-11 21:38:02','2025-09-11 21:38:02'),(5,'top_bar_whatsapp','https://wa.me/',NULL,1,'theme10',2,'2025-09-11 21:38:02','2025-09-11 21:38:02'),(6,'top_bar_instagram','https://instagram.com/',NULL,1,'theme10',2,'2025-09-11 21:38:02','2025-09-11 21:38:02'),(7,'top_bar_twitter','https://twitter.com/',NULL,1,'theme10',2,'2025-09-11 21:38:02','2025-09-11 21:38:02'),(8,'top_bar_messenger','https://messenger.com/',NULL,1,'theme10',2,'2025-09-11 21:38:02','2025-09-11 21:38:02');
/*!40000 ALTER TABLE `store_theme_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `store_theme` varchar(191) DEFAULT NULL,
  `theme_dir` varchar(191) DEFAULT NULL,
  `domains` varchar(191) DEFAULT NULL,
  `domain_switch` varchar(191) NOT NULL DEFAULT 'off',
  `enable_domain` varchar(191) NOT NULL DEFAULT 'off',
  `content` text DEFAULT NULL,
  `item_variable` varchar(191) DEFAULT NULL,
  `enable_storelink` varchar(191) NOT NULL DEFAULT 'on',
  `enable_subdomain` varchar(191) DEFAULT NULL,
  `subdomain` varchar(191) DEFAULT NULL,
  `about` longtext DEFAULT NULL,
  `tagline` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `lang` varchar(5) NOT NULL DEFAULT 'en',
  `storejs` text DEFAULT NULL,
  `currency` varchar(191) NOT NULL DEFAULT '$',
  `currency_code` varchar(191) NOT NULL DEFAULT 'USD',
  `currency_symbol_position` varchar(191) DEFAULT 'pre',
  `currency_symbol_space` varchar(191) DEFAULT 'without',
  `google_analytic` varchar(191) DEFAULT NULL,
  `fbpixel_code` varchar(191) DEFAULT NULL,
  `metaimage` varchar(191) DEFAULT NULL,
  `metakeyword` varchar(191) DEFAULT NULL,
  `metadesc` varchar(191) DEFAULT NULL,
  `decimal_number` int(11) NOT NULL DEFAULT 2,
  `enable_rating` varchar(191) NOT NULL DEFAULT 'on',
  `enable_shipping` varchar(191) NOT NULL DEFAULT 'on',
  `address` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `state` varchar(191) DEFAULT NULL,
  `zipcode` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `invoice_logo` varchar(191) DEFAULT NULL,
  `blog_enable` varchar(191) NOT NULL DEFAULT 'on',
  `is_twilio_enabled` varchar(225) DEFAULT NULL,
  `twilio_sid` text DEFAULT NULL,
  `twilio_token` text DEFAULT NULL,
  `twilio_from` text DEFAULT NULL,
  `notification_number` text NOT NULL,
  `is_stripe_enabled` varchar(191) NOT NULL DEFAULT 'off',
  `stripe_key` text DEFAULT NULL,
  `stripe_secret` text DEFAULT NULL,
  `is_paypal_enabled` varchar(191) NOT NULL DEFAULT 'off',
  `paypal_mode` text DEFAULT NULL,
  `paypal_client_id` text DEFAULT NULL,
  `paypal_secret_key` text DEFAULT NULL,
  `mail_driver` text DEFAULT NULL,
  `mail_host` text DEFAULT NULL,
  `mail_port` text DEFAULT NULL,
  `mail_username` text DEFAULT NULL,
  `mail_password` text DEFAULT NULL,
  `mail_encryption` text DEFAULT NULL,
  `mail_from_address` text DEFAULT NULL,
  `mail_from_name` text DEFAULT NULL,
  `is_store_enabled` int(11) NOT NULL DEFAULT 1,
  `is_checkout_login_required` varchar(191) NOT NULL DEFAULT 'on',
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `enable_whatsapp` varchar(191) NOT NULL DEFAULT 'off',
  `whatsapp_number` varchar(191) DEFAULT NULL,
  `enable_telegram` varchar(191) DEFAULT NULL,
  `telegrambot` varchar(191) DEFAULT NULL,
  `telegramchatid` varchar(191) DEFAULT NULL,
  `enable_cod` varchar(191) NOT NULL DEFAULT 'off',
  `enable_bank` varchar(191) NOT NULL DEFAULT 'off',
  `bank_number` varchar(191) DEFAULT NULL,
  `enable_pwa_store` varchar(191) NOT NULL DEFAULT 'off',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES (1,'mobi-nardo','admin@mobi-nardo.com','theme10-v1','theme10',NULL,'off','off','Hi,\n        *Welcome to* {store_name},\n        Your order is confirmed & your order no. is {order_no}\n        Your order detail is:\n        Name : {customer_name}\n        Address : {billing_address} {billing_city} , {shipping_address} {shipping_city}\n        ~~~~~~~~~~~~~~~~\n        {item_variable}\n        ~~~~~~~~~~~~~~~~\n        Qty Total : {qty_total}\n        Sub Total : {sub_total}\n        Discount Price : {discount_amount}\n        Shipping Price : {shipping_amount}\n        Tax : {total_tax}\n        Total : {final_total}\n        ~~~~~~~~~~~~~~~~~~\n        To collect the order you need to show the receipt at the counter.\n        Thanks {store_name}\n        ','{sku} : {quantity} x {product_name} - {variant_name} + {item_tax} = {item_total}','on','off',NULL,NULL,NULL,'my-store','en',NULL,'DH','MAD','post','with',NULL,NULL,NULL,NULL,NULL,2,'off','off',NULL,NULL,NULL,NULL,NULL,'favicon_1757619426.png','invoice_logo_1.png','off',NULL,NULL,NULL,NULL,'','off',NULL,NULL,'off','sandbox',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'off',1,2,'off','','off','','','off','off',NULL,'off','2025-09-11 21:18:46','2025-09-12 00:13:00');
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template`
--

DROP TABLE IF EXISTS `template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `template` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `template_name` varchar(191) NOT NULL,
  `prompt` text NOT NULL,
  `module` varchar(191) NOT NULL,
  `field_json` text NOT NULL,
  `is_tone` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template`
--

LOCK TABLES `template` WRITE;
/*!40000 ALTER TABLE `template` DISABLE KEYS */;
INSERT INTO `template` VALUES (1,'name','\"Create creative product names:  ##description## \\n\\nSeed words: ##keywords## \\n\\n\" in comma seprate and no number','products','{\"field\":[{\"label\":\"Seed words\",\"placeholder\":\"e.g.  fast, healthy, compact\",\"field_type\":\"text_box\",\"field_name\":\"keywords\"},{\"label\":\"Product Description\",\"placeholder\":\"e.g. Provide product details\",\"field_type\":\"textarea\",\"field_name\":\"description\"}]}',0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(2,'description','Write a long creative product description for: ##title##','products','{\"field\":[{\"label\":\"Product name\",\"placeholder\":\"e.g. VR, Honda\",\"field_type\":\"text_box\",\"field_name\":\"title\"},{\"label\":\"Audience\",\"placeholder\":\"e.g. Women, Aliens\",\"field_type\":\"text_box\",\"field_name\":\"audience\"},{\"label\":\"Product Description\",\"placeholder\":\"e.g. VR is an innovative device that can allow you to be part of virtual world\",\"field_type\":\"textarea\",\"field_name\":\"description\"}]}',1,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(3,'specification','Write a long creative product Specification for: ##title## \\n\\nTarget audience is: ##audience## \\n\\nUse this description: ##description## \\n\\nTone of generated text must be:\\n ##tone_language## \\n\\n','products','{\"field\":[{\"label\":\"Product name\",\"placeholder\":\"e.g. VR, Honda\",\"field_type\":\"text_box\",\"field_name\":\"title\"},{\"label\":\"Audience\",\"placeholder\":\"e.g. Women, Aliens\",\"field_type\":\"text_box\",\"field_name\":\"audience\"},{\"label\":\"Product Description\",\"placeholder\":\"e.g. VR is an innovative device that can allow you to be part of virtual world\",\"field_type\":\"textarea\",\"field_name\":\"description\"}]}',1,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(4,'detail','Write a long creative product detaion for: ##title## \\n\\nUse this description: ##description## \\n\\nTone of generated text must be:\\n ##tone_language## \\n\\n','products','{\"field\":[{\"label\":\"Product name\",\"placeholder\":\"e.g. VR, Honda\",\"field_type\":\"text_box\",\"field_name\":\"title\"},{\"label\":\"Product Description\",\"placeholder\":\"e.g. VR is an innovative device that can allow you to be part of virtual world\",\"field_type\":\"textarea\",\"field_name\":\"description\"}]}',1,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(5,'name','give catchy only name of category  for : ##keywords##  without icon or emojis','category','{\"field\":[{\"label\":\"Seed words\",\"placeholder\":\"e.g.  fast, healthy, compact\",\"field_type\":\"text_box\",\"field_name\":\"keywords\"}]}',0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(6,'name','give 1 catchy only name of Offer or discount Coupon  for : ##keywords## ','coupan','{\"field\":[{\"label\":\"Seed words\",\"placeholder\":\"e.g.  fast, healthy, compact\",\"field_type\":\"text_box\",\"field_name\":\"keywords\"}]}',0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(7,'name','I am starting a #### shipping service and need a unique name that reflects style, efficiency, and reliability. Can you help me come up with some creative options?','shipping','{\"field\":[{\"label\":\"What do want to ship? \",\"placeholder\":\"e.g.  Cloth, Electronics,\",\"field_type\":\"text_box\",\"field_name\":\"keywords\"}]}',0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(8,'name','please suggest only name for advance level or extraordinary page  which i can use in my \"##description##\" website','custom page','{\"field\":[{\"label\":\"Describe your website \",\"placeholder\":\"e.g. Describe your website details \",\"field_type\":\"textarea\",\"field_name\":\"description\"}]}',0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(9,'contents','please generate content for \"##title##\" page  which i can use in my \"##description##\"\\n\\nTone of generated text must be:\\n ##tone_language## \\n\\n website','custom page','{\"field\":[{\"label\":\"What is your Page title?\",\"placeholder\":\"e.g. Outstanding achievements,contact us\",\"field_type\":\"text_box\",\"field_name\":\"title\"},{\"label\":\"Describe your website \",\"placeholder\":\"e.g. Describe your website details \",\"field_type\":\"textarea\",\"field_name\":\"description\"}]}',1,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(10,'title','Generate blog titles for:\\n\\n ##description## \\n\\n','blog','{\"field\":[{\"label\":\"What is your blog post is about?\",\"placeholder\":\"e.g. Describe your blog post\",\"field_type\":\"textarea\",\"field_name\":\"description\"}]}',0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(11,'detail','\"please generate detailed blog for this title :##description##\\n\\nTone of generated text must be:\\n ##tone_language## \\n\\n for your business with intro & conclusion\"','blog','{\"field\":[{\"label\":\"What is your blog post is about?\",\"placeholder\":\"e.g. Describe your blog post\",\"field_type\":\"textarea\",\"field_name\":\"description\"}]}',1,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(12,'name','please suggest subscription plan  name  for this  :  ##description##  for my business','plan','{\"field\":[{\"label\":\"What is your plan about?\",\"placeholder\":\"e.g. Describe your plan details \",\"field_type\":\"textarea\",\"field_name\":\"description\"}]}',0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(13,'description','please suggest subscription plan  description  for this  :  \"##title##\\n\\nTone of generated text must be:\\n ##tone_language## \\n\\n  for my business','plan','{\"field\":[{\"label\":\"What is your plan title?\",\"placeholder\":\"e.g. Pro Resller,Exclusive Access\",\"field_type\":\"text_box\",\"field_name\":\"title\"}]}',1,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(14,'cookie_title','please suggest me cookie title for this ##description## website   which i can use in my website cookie','cookie','{\"field\":[{\"label\":\"Website name or info\",\"placeholder\":\"e.g. example website \",\"field_type\":\"textarea\",\"field_name\":\"title\"}]}',0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(15,'strictly_cookie_title','please suggest me only Strictly Cookie Title for this ##description##  website which i can use in my website cookie','cookie','{\"field\":[{\"label\":\"Website name or info\",\"placeholder\":\"e.g. example website \",\"field_type\":\"textarea\",\"field_name\":\"title\"}]}',0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(16,'cookie_description','please suggest me  Cookie description for this cookie title \"##title##\"\\n\\nTone of generated text must be:\\n ##tone_language## \\n\\n   which i can use in my website cookie','cookie','{\"field\":[{\"label\":\"Cookie Title \",\"placeholder\":\"e.g. example website \",\"field_type\":\"text_box\",\"field_name\":\"title\"}]}',1,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(17,'strictly_cookie_description','please suggest me Strictly Cookie description for this Strictly cookie title \"##title## \"\\n\\nTone of generated text must be:\\n ##tone_language## \\n\\n   which i can use in my website cookie','cookie','{\"field\":[{\"label\":\"Strictly Cookie Title \",\"placeholder\":\"e.g. example website \",\"field_type\":\"text_box\",\"field_name\":\"title\"}]}',1,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(18,'more_information_description','I need assistance in crafting compelling content for my ##web_name##\\n\\nTone of generated text must be:\\n ##tone_language## \\n\\n website Contact Us page of my website. The page should provide relevant information to users, encourage them to reach out for inquiries, support, and feedback, and reflect the unique value proposition of my business.','cookie','{\"field\":[{\"label\":\"Websit Name\",\"placeholder\":\"e.g. example website \",\"field_type\":\"text_box\",\"field_name\":\"web_name\"}]}',1,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(19,'metadesc','\"Write SEO meta description for:\\n\\n ##description## \\n\\nWebsite name is:\\n ##title## \\n\\nSeed words:\\n ##keywords## \\n\\nTone of generated text must be:\\n ##tone_language## \\n\\n\"','meta','{\"field\":[{\"label\":\"Website Name\",\"placeholder\":\"e.g. Amazon, Google\",\"field_type\":\"text_box\",\"field_name\":\"title\"},{\"label\":\"Website Description\",\"placeholder\":\"e.g. Describe what your website or business do\",\"field_type\":\"textarea\",\"field_name\":\"description\"},{\"label\":\"Keywords\",\"placeholder\":\"e.g.  cloud services, databases\",\"field_type\":\"text_box\",\"field_name\":\"keywords\"}]}',1,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(20,'metakeyword','\"Write SEO meta title for:\\n\\n ##description## \\n\\nWebsite name is:\\n ##title## \\n\\nSeed words:\\n ##keywords## \\n\\n\"','meta','{\"field\":[{\"label\":\"Website Name\",\"placeholder\":\"e.g. Amazon, Google\",\"field_type\":\"text_box\",\"field_name\":\"title\"},{\"label\":\"Website Description\",\"placeholder\":\"e.g. Describe what your website or business do\",\"field_type\":\"textarea\",\"field_name\":\"description\"},{\"label\":\"Keywords\",\"placeholder\":\"e.g.  cloud services, databases\",\"field_type\":\"text_box\",\"field_name\":\"keywords\"}]}',0,'2025-09-11 21:18:47','2025-09-11 21:18:47'),(21,'store_name','\"Create creative Store names: ##description## \\n\\nSeed words: ##keywords## \\n\\n\"','store','{\"field\":[{\"label\":\"Seed words\",\"placeholder\":\"e.g.  Store\",\"field_type\":\"text_box\",\"field_name\":\"keywords\"},{\"label\":\"Store Description\",\"placeholder\":\"e.g. Store product details\",\"field_type\":\"textarea\",\"field_name\":\"description\"}]}',0,'2025-09-11 21:18:47','2025-09-11 21:18:47');
/*!40000 ALTER TABLE `template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) NOT NULL,
  `sub_title` varchar(191) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `ratting` varchar(191) DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_coupons`
--

DROP TABLE IF EXISTS `user_coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_coupons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `coupon` int(11) NOT NULL,
  `order` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_coupons`
--

LOCK TABLES `user_coupons` WRITE;
/*!40000 ALTER TABLE `user_coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` varchar(191) NOT NULL,
  `customer_id` varchar(191) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `billing_address` varchar(191) NOT NULL,
  `billing_country` varchar(191) NOT NULL,
  `billing_city` varchar(191) NOT NULL,
  `billing_postalcode` varchar(191) NOT NULL,
  `shipping_address` varchar(191) DEFAULT NULL,
  `custom_field_title_1` varchar(191) DEFAULT NULL,
  `custom_field_title_2` varchar(191) DEFAULT NULL,
  `custom_field_title_3` varchar(191) DEFAULT NULL,
  `custom_field_title_4` varchar(191) DEFAULT NULL,
  `shipping_country` varchar(191) DEFAULT NULL,
  `shipping_city` varchar(191) DEFAULT NULL,
  `shipping_postalcode` varchar(191) DEFAULT NULL,
  `location_id` int(11) NOT NULL DEFAULT 0,
  `shipping_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_details`
--

LOCK TABLES `user_details` WRITE;
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_email_templates`
--

DROP TABLE IF EXISTS `user_email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_email_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `template_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_email_templates`
--

LOCK TABLES `user_email_templates` WRITE;
/*!40000 ALTER TABLE `user_email_templates` DISABLE KEYS */;
INSERT INTO `user_email_templates` VALUES (1,1,1,1,'2025-09-11 21:18:46','2025-09-11 21:18:46'),(2,2,1,1,'2025-09-11 21:18:46','2025-09-11 21:18:46'),(3,3,1,1,'2025-09-11 21:18:46','2025-09-11 21:18:46'),(4,4,1,1,'2025-09-11 21:18:46','2025-09-11 21:18:46');
/*!40000 ALTER TABLE `user_email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_stores`
--

DROP TABLE IF EXISTS `user_stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_stores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `permission` text NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_stores`
--

LOCK TABLES `user_stores` WRITE;
/*!40000 ALTER TABLE `user_stores` DISABLE KEYS */;
INSERT INTO `user_stores` VALUES (1,2,1,'Owner',1,'2025-09-11 21:18:46','2025-09-11 21:18:46');
/*!40000 ALTER TABLE `user_stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `lang` varchar(191) DEFAULT NULL,
  `current_store` int(11) DEFAULT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'user',
  `plan` int(11) NOT NULL DEFAULT 1,
  `plan_expire_date` date DEFAULT NULL,
  `requested_plan` int(11) NOT NULL DEFAULT 0,
  `trial_plan` int(11) NOT NULL DEFAULT 0,
  `trial_expire_date` date DEFAULT NULL,
  `storage_limit` double NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `mode` varchar(191) NOT NULL DEFAULT 'light',
  `plan_is_active` int(11) NOT NULL DEFAULT 1,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `is_enable_login` int(11) NOT NULL DEFAULT 1,
  `referral_code` int(11) NOT NULL DEFAULT 0,
  `used_referral_code` int(11) NOT NULL DEFAULT 0,
  `commission_amount` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Admin','superadmin@example.com','2025-09-11 21:18:46','$2y$10$3PSgMTzy1m9RIOnHQveHIO.GwvloWLtuJFh9m35AKdeee4hqR5EQe',NULL,'en',NULL,NULL,'super admin',1,NULL,0,0,NULL,0,0,'light',1,1,1,0,0,0,'2025-09-11 21:18:46','2025-09-11 21:18:46'),(2,'ishack','admin@mobi-nardo.com','2025-09-11 21:18:46','$2y$10$qe0FOri0uv3zOw9tNraDp.0LAuuBW5E23ipAT05vMGns88S4NVT1O',NULL,'fr',1,NULL,'Owner',1,NULL,0,0,NULL,20.52,1,'light',1,1,1,637431,0,0,'2025-09-11 21:18:46','2026-02-22 02:27:30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitor`
--

DROP TABLE IF EXISTS `visitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitor` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `method` varchar(191) DEFAULT NULL,
  `request` mediumtext DEFAULT NULL,
  `url` mediumtext DEFAULT NULL,
  `referer` mediumtext DEFAULT NULL,
  `languages` text DEFAULT NULL,
  `useragent` text DEFAULT NULL,
  `headers` text DEFAULT NULL,
  `device` text DEFAULT NULL,
  `platform` text DEFAULT NULL,
  `browser` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `visitable_type` varchar(191) DEFAULT NULL,
  `visitable_id` bigint(20) unsigned DEFAULT NULL,
  `visitor_type` varchar(191) DEFAULT NULL,
  `visitor_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `visitor_visitable_type_visitable_id_index` (`visitable_type`,`visitable_id`),
  KEY `visitor_visitor_type_visitor_id_index` (`visitor_type`,`visitor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitor`
--

LOCK TABLES `visitor` WRITE;
/*!40000 ALTER TABLE `visitor` DISABLE KEYS */;
INSERT INTO `visitor` VALUES (1,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip, deflate, br, zstd\"],\"accept-language\":[\"en-US,en;q=0.9\"],\"cookie\":[\"storego_saas_session=eyJpdiI6IkErMXFiQmFLUEZ6QzNQOGp4ejdZT2c9PSIsInZhbHVlIjoiUU1zQUFYSjNMMWdtMDNPUXQ1Umt3SVd4UW15RkVEdy85K3N0QXRVNTRWd3JCcXQ3T2RneURRcFE5MGF2dUFtUzlZYnQxUXcrQWxudWdHSHhyd2c2L3pQdk81b25lNFBJQ1ZNQlBqeTBTZFZ1ejZTeDQwTm93Ykozc09sWVpTZk54MWFISUI4OGRrTk5WZ0Vaa2c3RXZQaHhhVUdRdGhJVlNsQm9OdmhEbmc5M0daaWpvaCtFR2NDSXViWDNYL0JYL29KLzRxWVkvenIyOXZHUk94Z0RTV2tCRmVPWFhzclBFZUxndmFkVVN6MW9idGduYlhlZzdoSDAvVzBzd3FralZ0QlY4c3E5QitTZzdVMi9tZ0RTQ2pVTXRzMjQzKzFmSmN2MUpxVWlQSHA5Zk4wS1FGZUZpNDN3WWsrWEhCd3A1Q0ZUMFhJT1RoUXlCbEh0VEF2SnVrNUFJejFEdE5TWEZwRXZKUHZHUFEyNHVtWnIxSlBNUXlOV2ZyV3FkejllMmpqdHZYNmhub09NYk04MFdxV05wUFpkaEh3NWRwanVvaGtpRmRvY1RuZ1MzTWFlTUgzTTRHcnhPcS9lcnFQb09iYkt1ODZHSlMya3ArNzlaanZNV1BhM0NYZE1Oc3VLbzBVTzJ3YzlLdURLL0JPaXRKaXFtODNBNHVLbm5Mem8iLCJtYWMiOiI5MmY4ZGY0N2JjZjBiMmM4MzIyOWMyMWVhYTQ4ZWQ2MGY3YTkwYzAxOTI3YjNiNWJlNjAxYmI3MWUxMzQ5ODcxIiwidGFnIjoiIn0%3D; cc_cookie={\\\"level\\\":[\\\"necessary\\\"],\\\"revision\\\":0,\\\"data\\\":null,\\\"rfc_cookie\\\":false}; cookie_consent_logged=1; XSRF-TOKEN=eyJpdiI6IjJBd0JHQlllNVUvZ1RCZHNISm9QNEE9PSIsInZhbHVlIjoiZHJEdEFadmhpVlpRODNWTVBWZGIxL2hCc2dHcS9PVjQyMlArM2xNcjFrTXl0ODRxbDE4WEpDM0VoTW55Tk03NFdlS0c4aGpzbCs4Sm51S1RrY1R4VmROMlkwblBhL3ZQbTU2c0VUM0YxWGxCcDNVb2hCM0FWUnFXTzZla2FlNW9DSDlHb3Q1dWkyRmNBTXFTTXczTEtRS01aMHRVSDFwL0ZGUm56MkVvandmNGREc2RraXM1TjgrNEFMZkhHVVpEQyt3V09iczJzbTRCNkhqNXJHQXN0ZmFHWC9vT1htT0dtbEVWcC9VZkV5dHUzMFdrbGVMdnN1L2FacTBPTlRPdDZKbjQ1bDdpb1lVN2tGS25kSzB3ZFZGSUcwdlF5V2hUU0lvend4M21LSDVYWFpWMUZDN01KV2VEM0svY0IxZHF3eUI4Zk9UbFphN0h2dy9DalVrZi9CbUZRZE00Y2czeVUreE5FMzJyaHYxMTlHa1ZkWFhsUHNLT1E2SWZVdy9jTTQrMXBoeHFvQ2FpYW4xeUwvc2FsZGZxc2RyL0FLMXhYMW5OdjN5Q1NsVW1OSVhlUGxjVFhxeWxUUXV3R2xJcEZpNEt1ZDJaNTZRRm43V3JpUERjaFY5YVVPRTUvcjRvSGNHY3hQQk1zNmR5Si90c3ZsVytsclhvN3hZaktCU2MiLCJtYWMiOiI0ZWI4NzhiNzljZjE0NTM4MWFmMDYxM2MwM2E1MGRiMGZhMzM2N2JiNDE5NWZiMDg4ZTNhZjc4NmQwMDAwNjVjIiwidGFnIjoiIn0%3D; gestionmobi_nardocom_session=eyJpdiI6IkxmK3Zpck5WT1p1SHN4VXJteTZwWWc9PSIsInZhbHVlIjoiWFc1S29CYlRQQ2JHNlIwSnBiZFl2ZXFBVDlqK2RleWlaRHEvckhZTnBIUjJ5NjFOUFFNelIxR2xBczY4LzlUVi9JRkZyalpwZHhwSHFtTzdmUEtRZ1grZHk2TGxGSXoxc2Z3OXpYSjVUeXdzUU5rc2w3cUc3aWZERUZ0cnVtbnBsNGNzbmlWVW8zN3ZmanVveXFZTEhJamxaL3pQempZOHNWbk8rYW1PWEluUVNDcjZxZWNhUEZXMzNEdGVCYWtpWksvQ1RmZ3NadW5uRC9nMEtYeldtNWZaLzNvNW8zdWJwR2pNU3NzWFR5VUdhUW1qbTBiTzdUZFozS1BKT0hsYnlyRnA4YVFLdHJnaFllSGhiQkU2cGNQM3BIbzVzOHV6VzJnZjlJWnhvdnN4SWJtQmozYVJwVGdpQ2YrZGNUdzE0aWUvcDZYajdQWFp0aGt3QzRKKzdRUnJxOEFtYWtvcjRDT3Fybk5ieDFUWmtZKyszeVZncHZReWJnbGpHdWFoRGMrRGpBT2JucXhLWXhBSVBFRFJVZnMvRVZFWVUxb3RTOVM5aGhsRm5CSFlZMjJheWcrZkhFWW5KK2ROZUdPSTBzYXZJV0dpQ1VWVlpVZjZsK2tWd291Y3FDWFpBdkkwbloxWE9qZlk1SCt0WnFVRVU2aXJJMDZQSXFDaTB0cTciLCJtYWMiOiIyNDMyOTFiN2U2OWExNzIyM2FmNTkwNWUyMTFkM2FhNjBkMjA2MWVmMDg4YTA4NzA5MDQwNWRlNmM4NDJjOTJiIiwidGFnIjoiIn0%3D\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/139.0.0.0 Safari\\/537.36\"],\"x-forwarded-for\":[\"41.143.21.10\"],\"sec-ch-ua\":[\"\\\"Not;A=Brand\\\";v=\\\"99\\\", \\\"Google Chrome\\\";v=\\\"139\\\", \\\"Chromium\\\";v=\\\"139\\\"\"],\"sec-ch-ua-mobile\":[\"?0\"],\"sec-ch-ua-platform\":[\"\\\"Windows\\\"\"],\"upgrade-insecure-requests\":[\"1\"],\"sec-fetch-site\":[\"none\"],\"sec-fetch-mode\":[\"navigate\"],\"sec-fetch-user\":[\"?1\"],\"sec-fetch-dest\":[\"document\"],\"priority\":[\"u=0, i\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','Windows','Chrome','41.143.21.10','my-store',NULL,NULL,'App\\Models\\User',2,'2025-09-11 21:28:21','2025-09-11 21:28:21'),(2,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip, deflate, br, zstd\"],\"accept-language\":[\"en-US,en;q=0.9\"],\"cookie\":[\"storego_saas_session=eyJpdiI6IkErMXFiQmFLUEZ6QzNQOGp4ejdZT2c9PSIsInZhbHVlIjoiUU1zQUFYSjNMMWdtMDNPUXQ1Umt3SVd4UW15RkVEdy85K3N0QXRVNTRWd3JCcXQ3T2RneURRcFE5MGF2dUFtUzlZYnQxUXcrQWxudWdHSHhyd2c2L3pQdk81b25lNFBJQ1ZNQlBqeTBTZFZ1ejZTeDQwTm93Ykozc09sWVpTZk54MWFISUI4OGRrTk5WZ0Vaa2c3RXZQaHhhVUdRdGhJVlNsQm9OdmhEbmc5M0daaWpvaCtFR2NDSXViWDNYL0JYL29KLzRxWVkvenIyOXZHUk94Z0RTV2tCRmVPWFhzclBFZUxndmFkVVN6MW9idGduYlhlZzdoSDAvVzBzd3FralZ0QlY4c3E5QitTZzdVMi9tZ0RTQ2pVTXRzMjQzKzFmSmN2MUpxVWlQSHA5Zk4wS1FGZUZpNDN3WWsrWEhCd3A1Q0ZUMFhJT1RoUXlCbEh0VEF2SnVrNUFJejFEdE5TWEZwRXZKUHZHUFEyNHVtWnIxSlBNUXlOV2ZyV3FkejllMmpqdHZYNmhub09NYk04MFdxV05wUFpkaEh3NWRwanVvaGtpRmRvY1RuZ1MzTWFlTUgzTTRHcnhPcS9lcnFQb09iYkt1ODZHSlMya3ArNzlaanZNV1BhM0NYZE1Oc3VLbzBVTzJ3YzlLdURLL0JPaXRKaXFtODNBNHVLbm5Mem8iLCJtYWMiOiI5MmY4ZGY0N2JjZjBiMmM4MzIyOWMyMWVhYTQ4ZWQ2MGY3YTkwYzAxOTI3YjNiNWJlNjAxYmI3MWUxMzQ5ODcxIiwidGFnIjoiIn0%3D; cc_cookie={\\\"level\\\":[\\\"necessary\\\"],\\\"revision\\\":0,\\\"data\\\":null,\\\"rfc_cookie\\\":false}; cookie_consent_logged=1; XSRF-TOKEN=eyJpdiI6IktKM2tEUUxERFRwV1JLWnNJQmVmcGc9PSIsInZhbHVlIjoiSDN5MFJ2em1malBGNjY5L1ZPakYwMVhqMURyVndYZDd4RFNnN21zOGYyaTBRL1B3SUJMR0IyRCtYNzcvN3pnY2RFTGdtcXdNdEgreXN1TkgxcVFPYVdTaENTdlAvRDRmb1pFdFZ3U3ZTRWNsbzFlNnJEdnhjV0E0cUNHYVdzcEQrNHNHYmZLWEZBZW9RMnUxcCtncnhBekMxRFJBU1IxS3FHaWdPTU5oQlRxL0ZRbm1yNDJYQ1F5TFhicFhET0hzVnlKOXIrMXpnRFZUQXUySnVjZVJERFdLZXRDZ29MdG1rY0VEOXFwN0VKQjJlaXpBS1RDZUhrV0VyYU4wanhHNU02NVlPUnE5dTN3aWJkSlVDc2hTWWZ4RjRXNUlkemNqVWxFT25FK0FvamJKRmFLelhFcjgwemhmbUw0dm4ycHBkRU9JWDVVR3cwVG5jSFdVS3RsZGJnTWVVc3RRNlNQTFgveUw4QjhUbkNaYWpLaUtsZzdRTkJZd1VmdFNXcDBScVZhQUxhMFozOHFvdFo3QS95OEc2WnRCV3p0cmdLSWxmRVIwTWVJVjNUb2NKT2IyVUdMc3NEbjk1dHV1clFkdnBnREJST0xudkVqd3ZpYVltbVVoT1dUd0hTa3dMRG0xeEozRXQ5RkhXQWV0TTY1d0xnUTJiK0tseDhhUlc1VVQiLCJtYWMiOiI3OTY1NGI4NzE4MzQzNzBlMGJlOTE2YzQzYWMwN2E3ZjVkY2FhYmJiMDQ5ODVmOTI4NTMyZjBiNWZhYzA1MzFlIiwidGFnIjoiIn0%3D; gestionmobi_nardocom_session=eyJpdiI6IkJCdUFxalFyYzdYSm9vL2xjT2liK1E9PSIsInZhbHVlIjoibTVuK3A5ZDN3d2kyZ0tnQmVDd2paczU4dWZDMTRKdFZMRUE4Y0ZHV256OTFvTDFmNm9IcGR3QU5YcTJ1UWdTdE1hd0M1VWs3OERiOWJCMEFkdTZnYlBSVUk4TTZLWXZkUWp5VFJsV2lScDZXYlI3MTREMlRBSktRY01CSjlxNUxXVHRTcHJoY045WWR3cUxGdVNaaEU2Mjg4aUlUN21zMEFESGZDNDM5VUtIVXozbWZpMmYvT2FOV0FHNDBjcDRhNm9weDVYWTVaWE9IaXo4d25MN1RnNnhzMlRrMUdLZE1jOHZSZk1seWFneFFjYXVyN3QxcmZJZ2kzTmtMMDdxSEVic2NsWlM1c05nQXl5UzhNdkg0K1Jka1BiZDNBZUhvcVh3QUZjS0Z4QjY2VlJJVGR2VVFoekZzcXlFNXlEbWMrVjdWZTVLbWY3VzUza2U0YVc0T3dqWlowQTR0dE11NWV0cFdQTGUzcjRIdllTSEhGN3BIOTBpaGRmTk1wMDd1TDVYeDNPcnZmamp1TWd2WUwvT1ZkTnlCeEJ2MlV3UGRocU05NURSUlRkUERQNTBvcW9OQ3k0dHk4V2ZHVGxYYUNSd3psK0tiYktYVUdQMlVrM2pydVZ6c2E3WFozNitFMGFXVzFkZWx4dXF5VEwya09RWTBxdkgzSVlZT2dvNDMiLCJtYWMiOiJhYjkxYzczODQwZDJkMzQ1NGRjYzBmYjI4NmIzY2RiZWRhNWI3N2I2NjFiMTEwYWVhODFkNmNiNjM2YjA2MDEyIiwidGFnIjoiIn0%3D\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/139.0.0.0 Safari\\/537.36\"],\"x-forwarded-for\":[\"41.143.21.10\"],\"sec-ch-ua\":[\"\\\"Not;A=Brand\\\";v=\\\"99\\\", \\\"Google Chrome\\\";v=\\\"139\\\", \\\"Chromium\\\";v=\\\"139\\\"\"],\"sec-ch-ua-mobile\":[\"?0\"],\"sec-ch-ua-platform\":[\"\\\"Windows\\\"\"],\"upgrade-insecure-requests\":[\"1\"],\"sec-fetch-site\":[\"none\"],\"sec-fetch-mode\":[\"navigate\"],\"sec-fetch-user\":[\"?1\"],\"sec-fetch-dest\":[\"document\"],\"priority\":[\"u=0, i\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','Windows','Chrome','41.143.21.10','my-store',NULL,NULL,'App\\Models\\User',2,'2025-09-11 21:31:39','2025-09-11 21:31:39'),(3,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip, deflate, br, zstd\"],\"accept-language\":[\"en-US,en;q=0.9\"],\"cookie\":[\"storego_saas_session=eyJpdiI6IkErMXFiQmFLUEZ6QzNQOGp4ejdZT2c9PSIsInZhbHVlIjoiUU1zQUFYSjNMMWdtMDNPUXQ1Umt3SVd4UW15RkVEdy85K3N0QXRVNTRWd3JCcXQ3T2RneURRcFE5MGF2dUFtUzlZYnQxUXcrQWxudWdHSHhyd2c2L3pQdk81b25lNFBJQ1ZNQlBqeTBTZFZ1ejZTeDQwTm93Ykozc09sWVpTZk54MWFISUI4OGRrTk5WZ0Vaa2c3RXZQaHhhVUdRdGhJVlNsQm9OdmhEbmc5M0daaWpvaCtFR2NDSXViWDNYL0JYL29KLzRxWVkvenIyOXZHUk94Z0RTV2tCRmVPWFhzclBFZUxndmFkVVN6MW9idGduYlhlZzdoSDAvVzBzd3FralZ0QlY4c3E5QitTZzdVMi9tZ0RTQ2pVTXRzMjQzKzFmSmN2MUpxVWlQSHA5Zk4wS1FGZUZpNDN3WWsrWEhCd3A1Q0ZUMFhJT1RoUXlCbEh0VEF2SnVrNUFJejFEdE5TWEZwRXZKUHZHUFEyNHVtWnIxSlBNUXlOV2ZyV3FkejllMmpqdHZYNmhub09NYk04MFdxV05wUFpkaEh3NWRwanVvaGtpRmRvY1RuZ1MzTWFlTUgzTTRHcnhPcS9lcnFQb09iYkt1ODZHSlMya3ArNzlaanZNV1BhM0NYZE1Oc3VLbzBVTzJ3YzlLdURLL0JPaXRKaXFtODNBNHVLbm5Mem8iLCJtYWMiOiI5MmY4ZGY0N2JjZjBiMmM4MzIyOWMyMWVhYTQ4ZWQ2MGY3YTkwYzAxOTI3YjNiNWJlNjAxYmI3MWUxMzQ5ODcxIiwidGFnIjoiIn0%3D; cc_cookie={\\\"level\\\":[\\\"necessary\\\"],\\\"revision\\\":0,\\\"data\\\":null,\\\"rfc_cookie\\\":false}; cookie_consent_logged=1; XSRF-TOKEN=eyJpdiI6ImJuOWE3Y2pVRjNVNVNPN056aHd1ZkE9PSIsInZhbHVlIjoiSmNmVENUWHQ2LzZBSU1JUldUT2R4c1Uvek5jS2diWG0zSEh1K0JaNm9MRGJ5QzYwU241ZWMvbUYwKzJLVTc2TXQ3WjZwT3prV3ZEc3gvejAyc2hCbys4a1lBdHk3b3JEQTZtODVaUEtjMWs2VXQ2WXdwdXVNbk9KYnc1ejdZeE9UK1RLZVA1YmE1NEppM3l0eU1DQXl5ckpGNVNXYUNPcnUydEVTOTNFR25tMVpieVBZdW9lc3V2RjZ1SFM0TG1FL2dDbFV0R0NrRTJlTWMzVU04TUxKZXJNRW9vTXZsRDl3V0F3bk1ZUGRxWk1MaVBDNDUrU2dndEdrcU0xaEIzMURuMks1QkVJQ1FTaW1meWJXVGtKaDN6NGhZdWdLSlZvekJ5V3lIdDFRc1VYRDFCWEhHbkV2QlF4ajQveldaS0I0OE9tWFkwZ1IzaEhITG85Vm90emZ4SEE0MFBVK1dBM2RlQWRyd08rWW5NbkJCaWlDdlNRWHR5eHQ5MHBZa0IrQ015Mnp2OWlJVVZqenpaaFk1M003MEJmdyttYmg4dHh1WGx3bEJOL1k0UERuamtHakxlbjJNeFZQWndnc01TSUtWQzZDUU9VUm9FeVhaT21ES3NPN1IzMGg4S01NWnJnUjVOSEVuRHRDRWRrTHlMUnltaXNJMWJxeWpXd1g5RjAiLCJtYWMiOiI4ODgyNTdkMTJmODk1Yjg1Y2EyN2MzYzM4MTBmMzcxZDk0ZDk3NTFhODE3OGUyZTdhYzg1ZGRhNmYwOWZiYTNkIiwidGFnIjoiIn0%3D; gestionmobi_nardocom_session=eyJpdiI6Ik5WR00xVWgzVk8rN3E1b2d2SVZRMlE9PSIsInZhbHVlIjoiSzAyRG1pNHl1d29aOEhKb2d1bVB0ZXV6UUdzc3ZOeTNkb2RrQ1NwMHBKMGJ6em8rSXBKYTlhK1hFUGxqZUR3aTk4SldQTWY2WTFSSkN1Vi9NaTBYeVhya0JNb2wzOG03VURTNVR4MElqRmRDVlEzQnNTa2NqemVkdFhRQ1FoUzFnQ3Q5YWdScmZDbnAwVUxjK1B2VFpiVEZzaUZLcXdvaDVyb2FlVkRVaE13MDRWWkR5VUJYRlJGVjlaOUNXUmVFcU1xMitZRFc2NWtVcXE4ODNXbEo4VjFwdGVpUmx6aTIvODMzeTYxaGZGV3NmQWV2dWpGTUtSeTUvQ0NPWFZneVhsRUpwNGk4RkdqM3BpMS9jVVdjMWN5K051dWpsN0FlS0pRZjZXcjBJcXoxVzFmTGE5MDRkaTNPTFNCOHJFQ1ZpamM2MGtKeVNMaGJoWENYWEQzSVFwTTBNU05UZ1ZjaDk0NmN5TXpReVZLWm4xWkkvWmtRTE9JUWRqdUFPMjljbHo4WkRlM2t3K1JBWTNpMHdVMHp5U1k2WTdvNVUyZlY2RFM5ZkEvT0JSd3hDUzczNHFPNWdPU3NVUFFBbWl1UkdBM280N3d0RmtFdDdveXQ0V0lDRytDZHdMZnZWWngxQWVpVTVycWRTanRWUW4rcllyMzVWNFNWdkxaemoyTGMiLCJtYWMiOiJiNTdjNDc3YWVmYjllZmUyZjI5YWMxZDgzYTE1ZGFkNzQ2OGQ0MWNmYjk2NjhhOWM0YWYxNzZlY2MyNDBhYjFmIiwidGFnIjoiIn0%3D\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/139.0.0.0 Safari\\/537.36\"],\"cache-control\":[\"max-age=0\"],\"x-forwarded-for\":[\"41.143.21.10\"],\"sec-ch-ua\":[\"\\\"Not;A=Brand\\\";v=\\\"99\\\", \\\"Google Chrome\\\";v=\\\"139\\\", \\\"Chromium\\\";v=\\\"139\\\"\"],\"sec-ch-ua-mobile\":[\"?0\"],\"sec-ch-ua-platform\":[\"\\\"Windows\\\"\"],\"upgrade-insecure-requests\":[\"1\"],\"sec-fetch-site\":[\"none\"],\"sec-fetch-mode\":[\"navigate\"],\"sec-fetch-user\":[\"?1\"],\"sec-fetch-dest\":[\"document\"],\"priority\":[\"u=0, i\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','Windows','Chrome','41.143.21.10','my-store',NULL,NULL,'App\\Models\\User',2,'2025-09-11 21:37:30','2025-09-11 21:37:30'),(4,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip, deflate, br, zstd\"],\"accept-language\":[\"en-US,en;q=0.9\"],\"cookie\":[\"storego_saas_session=eyJpdiI6IkErMXFiQmFLUEZ6QzNQOGp4ejdZT2c9PSIsInZhbHVlIjoiUU1zQUFYSjNMMWdtMDNPUXQ1Umt3SVd4UW15RkVEdy85K3N0QXRVNTRWd3JCcXQ3T2RneURRcFE5MGF2dUFtUzlZYnQxUXcrQWxudWdHSHhyd2c2L3pQdk81b25lNFBJQ1ZNQlBqeTBTZFZ1ejZTeDQwTm93Ykozc09sWVpTZk54MWFISUI4OGRrTk5WZ0Vaa2c3RXZQaHhhVUdRdGhJVlNsQm9OdmhEbmc5M0daaWpvaCtFR2NDSXViWDNYL0JYL29KLzRxWVkvenIyOXZHUk94Z0RTV2tCRmVPWFhzclBFZUxndmFkVVN6MW9idGduYlhlZzdoSDAvVzBzd3FralZ0QlY4c3E5QitTZzdVMi9tZ0RTQ2pVTXRzMjQzKzFmSmN2MUpxVWlQSHA5Zk4wS1FGZUZpNDN3WWsrWEhCd3A1Q0ZUMFhJT1RoUXlCbEh0VEF2SnVrNUFJejFEdE5TWEZwRXZKUHZHUFEyNHVtWnIxSlBNUXlOV2ZyV3FkejllMmpqdHZYNmhub09NYk04MFdxV05wUFpkaEh3NWRwanVvaGtpRmRvY1RuZ1MzTWFlTUgzTTRHcnhPcS9lcnFQb09iYkt1ODZHSlMya3ArNzlaanZNV1BhM0NYZE1Oc3VLbzBVTzJ3YzlLdURLL0JPaXRKaXFtODNBNHVLbm5Mem8iLCJtYWMiOiI5MmY4ZGY0N2JjZjBiMmM4MzIyOWMyMWVhYTQ4ZWQ2MGY3YTkwYzAxOTI3YjNiNWJlNjAxYmI3MWUxMzQ5ODcxIiwidGFnIjoiIn0%3D; cc_cookie={\\\"level\\\":[\\\"necessary\\\"],\\\"revision\\\":0,\\\"data\\\":null,\\\"rfc_cookie\\\":false}; cookie_consent_logged=1; XSRF-TOKEN=eyJpdiI6Im9xcUlaYWgxRFAxai9RVWdoNGJGSUE9PSIsInZhbHVlIjoieHREZHdSWnNkNlcwWTk0SUFHZ2dwdlJ1b090TE1HN3l3U29vS2M4aUpMTS9oR2UxMXEvTWg1S3A1aFVMeElPbjlWQ0ljaDJNZXhGcjRUa0JubktaTkkwVUVPVHJkR3NwSE41eFVydGVxVTZyekVpdk9CelRnWm0rYWhrRGloRExVTVZ2OGpsZ2d4R1JRU3I0ZFp0WkMvUldNUDJrSTBsYlB6VW8zOGxzMGlWSnRSUzRxb2VVZlc4eXpxV1AxNWdoVHFyV0lPSFA5dlZpZ3lsOGNUQ0Qyem4yWU80RVQvRHlkaXlnVkczbWVYcU5DKzdwNmN2WVlyVnZMMzk1dzBYS0p3SlJIMk5kWWpPWGl5cUlPL0dyenpiMzltUWtKUkI5R05VeFZUNjF5RnB2SEtZM3JJYW52RjhZTFlrYjh1S1dISGpxM2hWSlpXOURCdysrZmUzUDFMT0Q4amttMUJiZEovb05rTXRSeXBPUFJ4VU5RalowK2tuM0g5c01iZWs3ODZHRHlFNDdnazJNdXlEK216aXRBeHZ0N1hoNlBjV0JnejBiK3liM3lqcHRLWEtPMTJOUVRRbE9uMG4yOFYyYVBwR2VrRWp4UmxBMG5nTll6ck90Tm1aMVR4WjY4Yy9xS0VESkkvL09DWHA5SFd0M0lCUks4T1JrQVhEcCttMFYiLCJtYWMiOiI2NDEwMTM3ZjhhMzdlYzc0MTQxNjE0M2ZhMDBmMjI2NTRkYWRlMTAxNzMyYjg4ZjU0OWVhYzY1NjAyMGU1Yjg2IiwidGFnIjoiIn0%3D; gestionmobi_nardocom_session=eyJpdiI6IllsWngycVlUeWFvRFQzZllMK1EwK1E9PSIsInZhbHVlIjoiY2lvc0paT0owQ3ZlMWJRU0NXb0x1cUxsb3NUR0VHRUtkUHN4VzErZFFITDdRczQzZmdyT2dmYnVHN095QnJ6SFZ1Rm1zckZSb0ZsOHdTSmJRc1Z5R0krYlM1TDdUMDloN2pxUHVNSnV2V3BMQnlGcFZnQXhMaldlSlRwU1lPRS9lanFtcEw5VE96NngvU1grQmtzU3ZYVG5zZjVhU3FqYkpqOHZCb0ZMNEh4TkVMbU4zSE1kdVFKeTRWcXRQVGN6SE1xZnFhK3lRWkpnc2Z2NTA3OXNCS1FIQUdkbjYzVVlsUytpdzNLNWVyZzV2WGtWTUlZdXVhbkhlWmgyaThoVmhzbm1sZlVybFM1ZVhHTU5qUnMzaXhGbHdla0FZeEZTSUVSVzhoNTFJRHpCUG9GdkswblN0eW1WT0tBdS8yU2Q0WDYyNnRvT0l4RHZRZjhZS1dGL2JJTi9oWGxJcXdOeFZ0MnR6eE5jOC9LK1N1VXd0WGN6Yi9hOE0yYW5odjcxbndPZkF2UzhHTjJyWHdTV1ZZa3F5dk9hMmo2ZXlRNUUrK0hTU0oxTGtJSXV4ZmkvQVFHU1N1Q05UVEZGNFZZaFZveC9UWXhQSGxhZ0gxVkI5VW4vRks4TEZSQ1lwemRnSnhYUitENC9tTmFkQ0NQWjFTdjRvK01vOHE0MWNBeXAiLCJtYWMiOiJjMzI0NThhY2JhNDRjNmRjN2QzYzJkYmEwY2U4NGI2MzdmYzViMTM2YTY5YmU5NzBkZGZlMmU1MzE0MGE0OTkzIiwidGFnIjoiIn0%3D\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/139.0.0.0 Safari\\/537.36\"],\"cache-control\":[\"max-age=0\"],\"x-forwarded-for\":[\"41.143.21.10\"],\"sec-ch-ua\":[\"\\\"Not;A=Brand\\\";v=\\\"99\\\", \\\"Google Chrome\\\";v=\\\"139\\\", \\\"Chromium\\\";v=\\\"139\\\"\"],\"sec-ch-ua-mobile\":[\"?0\"],\"sec-ch-ua-platform\":[\"\\\"Windows\\\"\"],\"upgrade-insecure-requests\":[\"1\"],\"sec-fetch-site\":[\"none\"],\"sec-fetch-mode\":[\"navigate\"],\"sec-fetch-user\":[\"?1\"],\"sec-fetch-dest\":[\"document\"],\"priority\":[\"u=0, i\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','Windows','Chrome','41.143.21.10','my-store',NULL,NULL,'App\\Models\\User',2,'2025-09-11 21:39:01','2025-09-11 21:39:01'),(5,'GET','[]','https://gestion.mobi-nardo.com/store/my-store','https://gestion.mobi-nardo.com/store/my-store','[]','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip, deflate, br, zstd\"],\"accept-language\":[\"en-US,en;q=0.9\"],\"cookie\":[\"storego_saas_session=eyJpdiI6IkErMXFiQmFLUEZ6QzNQOGp4ejdZT2c9PSIsInZhbHVlIjoiUU1zQUFYSjNMMWdtMDNPUXQ1Umt3SVd4UW15RkVEdy85K3N0QXRVNTRWd3JCcXQ3T2RneURRcFE5MGF2dUFtUzlZYnQxUXcrQWxudWdHSHhyd2c2L3pQdk81b25lNFBJQ1ZNQlBqeTBTZFZ1ejZTeDQwTm93Ykozc09sWVpTZk54MWFISUI4OGRrTk5WZ0Vaa2c3RXZQaHhhVUdRdGhJVlNsQm9OdmhEbmc5M0daaWpvaCtFR2NDSXViWDNYL0JYL29KLzRxWVkvenIyOXZHUk94Z0RTV2tCRmVPWFhzclBFZUxndmFkVVN6MW9idGduYlhlZzdoSDAvVzBzd3FralZ0QlY4c3E5QitTZzdVMi9tZ0RTQ2pVTXRzMjQzKzFmSmN2MUpxVWlQSHA5Zk4wS1FGZUZpNDN3WWsrWEhCd3A1Q0ZUMFhJT1RoUXlCbEh0VEF2SnVrNUFJejFEdE5TWEZwRXZKUHZHUFEyNHVtWnIxSlBNUXlOV2ZyV3FkejllMmpqdHZYNmhub09NYk04MFdxV05wUFpkaEh3NWRwanVvaGtpRmRvY1RuZ1MzTWFlTUgzTTRHcnhPcS9lcnFQb09iYkt1ODZHSlMya3ArNzlaanZNV1BhM0NYZE1Oc3VLbzBVTzJ3YzlLdURLL0JPaXRKaXFtODNBNHVLbm5Mem8iLCJtYWMiOiI5MmY4ZGY0N2JjZjBiMmM4MzIyOWMyMWVhYTQ4ZWQ2MGY3YTkwYzAxOTI3YjNiNWJlNjAxYmI3MWUxMzQ5ODcxIiwidGFnIjoiIn0%3D; cc_cookie={\\\"level\\\":[\\\"necessary\\\"],\\\"revision\\\":0,\\\"data\\\":null,\\\"rfc_cookie\\\":false}; cookie_consent_logged=1; XSRF-TOKEN=eyJpdiI6Ik9iQVRDd3dYbTk5VC83ZGRVdS9tc1E9PSIsInZhbHVlIjoibW5VOXRlSEFicTYyd0xOVmI5bTRkcEdlblFVY29wb0tFQUJTZlZRQkd0djlpemcrY2JJWTdsTDhleG5FL0M1b3pWS0xVRENFLzkzMkxKN09yVjhSd2JxOUxmem1meDE2d1dBa29pUlpXb3BxUFU3dkVzbGtzMHJmZG9OMXR1RVFiSHVEa3NJa3I2R3YwZzhFWlNtRnkzLzJzRXV6SmVqWWxzZ2Q4VjJLcE53bkNyTUZlaFkwOURJV0dFWlc2Z1ZqMnlNTTJWOHZsUzdRK0U0L3dhYVd0TGJYZ3VCNmhKRlovTWpSNDBWUEhWaHFVdG1peC9OOVU4R1IwTXlhTEwzc3BPL2xla21Yb0tVb3d0MERSMVRkMHRZdlQ4dXFNSS94WGVrMDRzczFnd3FocE1MQWFiSitBajg0QmVxSTZrampkbTNRN2I3TmNsUnRuZnVGUExjQXVlemxBRFhRZFFBa29lOGw5blFpVEhubGl1SEtjQmxwVU41c1FxaGV1Rks3TFh3TUpCaG1uTVdsQnI1RkxVR2R3U1kwYkc0U2IyNHdsR3YxQzFMblYvamVZRWlHb3Y4N2poaDRCZHFUOEVseHZWYlM0bDNzaWNFVHo1dDJuNVYwN3Y1eUFVcFNYYTV3SEYvaGZkMHduQlRtQU5pYTBWcHBzMityZFZLWlFWeHIiLCJtYWMiOiI1NjE1OWI2OGViN2FhNWM1NjAzYTYxNTE5MmQyZDMwMjllNzZkYmY3NjdkYmE0MmU5YjM0NWE1MWI2NTg4MDdjIiwidGFnIjoiIn0%3D; gestionmobi_nardocom_session=eyJpdiI6Ik9OZlNnOVkyMzBSMWJadGtHeGtVY2c9PSIsInZhbHVlIjoiVVRhVlBQV1VqclNya1dGdEZOQlFzYVphNzd1Nm5OcnNQNVYraGV4dG9yMWF2NHJNaUNReDlISjh5WUt6a1VPMWpOdkRRSTh6YzR2ZFFYNXFGT2o5YnhzQkdES3hvcTVERFhlTEg3dnBpR0pOeFhNOHpZYStDMjZzTXJxem9BREduUDdTZFlFL3JBcXRxd2ZHL0RDNWFRRUxUZ1A5dmQrWk9JdGtTOER2cDJDU1pzSVo0dU9JV1RvYVo1bXBPcnBzZmpsd0xpSmRaNitZSEJJbWpNcW1EZzc4VTNJS3VSMW5maEJNTkFVd3RKNXNBWVMvRzhLcW1Tb0R3bHpJc29IK1lHdmRKVlBsUGZNNTBwWUVqZUZmMUduV29pcE1QeTlIYXdEMDByVkRQaDJESTZqTDAxeGtMbHIyR3JXei80WGpZLzFoM04rNEJCYkRYekxuTWlTZWNGcnhtTnErVEllVnVtbGpmMGoxMW05K2JFSFBVNWkvU0VrRlBFbUZnalQvVWZRVUZiT09aeHVOMjFPS1IyeFZ1MjJ6SlVOMUJIL0w4YzV0dXNaQW44Qnd4V0d4VUdvQ21MSDd4UHJRRGhHc0JFazFERDlsalZ2TTVRa0w0WFBmNTdVL3FiR0JaQ0pJK3hxcXNrdEx5NU83NlhES3FuVTVkalZnK3V0RHo0MGoiLCJtYWMiOiJkNjRhNjIyYTcwYzMzNThiZTI4ODhjZjgyNDU1OTUxYWM3ZjM1ZmVlNzFkNzYyNmI2MGMzMThmOGI3ZDBjZjhjIiwidGFnIjoiIn0%3D\"],\"host\":[\"gestion.mobi-nardo.com\"],\"referer\":[\"https:\\/\\/gestion.mobi-nardo.com\\/store\\/my-store\"],\"user-agent\":[\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/139.0.0.0 Safari\\/537.36\"],\"x-forwarded-for\":[\"41.143.21.10\"],\"sec-ch-ua\":[\"\\\"Not;A=Brand\\\";v=\\\"99\\\", \\\"Google Chrome\\\";v=\\\"139\\\", \\\"Chromium\\\";v=\\\"139\\\"\"],\"sec-ch-ua-mobile\":[\"?0\"],\"sec-ch-ua-platform\":[\"\\\"Windows\\\"\"],\"upgrade-insecure-requests\":[\"1\"],\"sec-fetch-site\":[\"same-origin\"],\"sec-fetch-mode\":[\"navigate\"],\"sec-fetch-user\":[\"?1\"],\"sec-fetch-dest\":[\"document\"],\"priority\":[\"u=0, i\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','Windows','Chrome','41.143.21.10','my-store',NULL,NULL,'App\\Models\\User',2,'2025-09-11 21:41:22','2025-09-11 21:41:22'),(6,'GET','[]','https://gestion.mobi-nardo.com/store/my-store','https://gestion.mobi-nardo.com/store/my-store','[]','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip, deflate, br, zstd\"],\"accept-language\":[\"en-US,en;q=0.9\"],\"cookie\":[\"storego_saas_session=eyJpdiI6IkErMXFiQmFLUEZ6QzNQOGp4ejdZT2c9PSIsInZhbHVlIjoiUU1zQUFYSjNMMWdtMDNPUXQ1Umt3SVd4UW15RkVEdy85K3N0QXRVNTRWd3JCcXQ3T2RneURRcFE5MGF2dUFtUzlZYnQxUXcrQWxudWdHSHhyd2c2L3pQdk81b25lNFBJQ1ZNQlBqeTBTZFZ1ejZTeDQwTm93Ykozc09sWVpTZk54MWFISUI4OGRrTk5WZ0Vaa2c3RXZQaHhhVUdRdGhJVlNsQm9OdmhEbmc5M0daaWpvaCtFR2NDSXViWDNYL0JYL29KLzRxWVkvenIyOXZHUk94Z0RTV2tCRmVPWFhzclBFZUxndmFkVVN6MW9idGduYlhlZzdoSDAvVzBzd3FralZ0QlY4c3E5QitTZzdVMi9tZ0RTQ2pVTXRzMjQzKzFmSmN2MUpxVWlQSHA5Zk4wS1FGZUZpNDN3WWsrWEhCd3A1Q0ZUMFhJT1RoUXlCbEh0VEF2SnVrNUFJejFEdE5TWEZwRXZKUHZHUFEyNHVtWnIxSlBNUXlOV2ZyV3FkejllMmpqdHZYNmhub09NYk04MFdxV05wUFpkaEh3NWRwanVvaGtpRmRvY1RuZ1MzTWFlTUgzTTRHcnhPcS9lcnFQb09iYkt1ODZHSlMya3ArNzlaanZNV1BhM0NYZE1Oc3VLbzBVTzJ3YzlLdURLL0JPaXRKaXFtODNBNHVLbm5Mem8iLCJtYWMiOiI5MmY4ZGY0N2JjZjBiMmM4MzIyOWMyMWVhYTQ4ZWQ2MGY3YTkwYzAxOTI3YjNiNWJlNjAxYmI3MWUxMzQ5ODcxIiwidGFnIjoiIn0%3D; cc_cookie={\\\"level\\\":[\\\"necessary\\\"],\\\"revision\\\":0,\\\"data\\\":null,\\\"rfc_cookie\\\":false}; cookie_consent_logged=1; XSRF-TOKEN=eyJpdiI6Ik9iQVRDd3dYbTk5VC83ZGRVdS9tc1E9PSIsInZhbHVlIjoibW5VOXRlSEFicTYyd0xOVmI5bTRkcEdlblFVY29wb0tFQUJTZlZRQkd0djlpemcrY2JJWTdsTDhleG5FL0M1b3pWS0xVRENFLzkzMkxKN09yVjhSd2JxOUxmem1meDE2d1dBa29pUlpXb3BxUFU3dkVzbGtzMHJmZG9OMXR1RVFiSHVEa3NJa3I2R3YwZzhFWlNtRnkzLzJzRXV6SmVqWWxzZ2Q4VjJLcE53bkNyTUZlaFkwOURJV0dFWlc2Z1ZqMnlNTTJWOHZsUzdRK0U0L3dhYVd0TGJYZ3VCNmhKRlovTWpSNDBWUEhWaHFVdG1peC9OOVU4R1IwTXlhTEwzc3BPL2xla21Yb0tVb3d0MERSMVRkMHRZdlQ4dXFNSS94WGVrMDRzczFnd3FocE1MQWFiSitBajg0QmVxSTZrampkbTNRN2I3TmNsUnRuZnVGUExjQXVlemxBRFhRZFFBa29lOGw5blFpVEhubGl1SEtjQmxwVU41c1FxaGV1Rks3TFh3TUpCaG1uTVdsQnI1RkxVR2R3U1kwYkc0U2IyNHdsR3YxQzFMblYvamVZRWlHb3Y4N2poaDRCZHFUOEVseHZWYlM0bDNzaWNFVHo1dDJuNVYwN3Y1eUFVcFNYYTV3SEYvaGZkMHduQlRtQU5pYTBWcHBzMityZFZLWlFWeHIiLCJtYWMiOiI1NjE1OWI2OGViN2FhNWM1NjAzYTYxNTE5MmQyZDMwMjllNzZkYmY3NjdkYmE0MmU5YjM0NWE1MWI2NTg4MDdjIiwidGFnIjoiIn0%3D; gestionmobi_nardocom_session=eyJpdiI6Ik9OZlNnOVkyMzBSMWJadGtHeGtVY2c9PSIsInZhbHVlIjoiVVRhVlBQV1VqclNya1dGdEZOQlFzYVphNzd1Nm5OcnNQNVYraGV4dG9yMWF2NHJNaUNReDlISjh5WUt6a1VPMWpOdkRRSTh6YzR2ZFFYNXFGT2o5YnhzQkdES3hvcTVERFhlTEg3dnBpR0pOeFhNOHpZYStDMjZzTXJxem9BREduUDdTZFlFL3JBcXRxd2ZHL0RDNWFRRUxUZ1A5dmQrWk9JdGtTOER2cDJDU1pzSVo0dU9JV1RvYVo1bXBPcnBzZmpsd0xpSmRaNitZSEJJbWpNcW1EZzc4VTNJS3VSMW5maEJNTkFVd3RKNXNBWVMvRzhLcW1Tb0R3bHpJc29IK1lHdmRKVlBsUGZNNTBwWUVqZUZmMUduV29pcE1QeTlIYXdEMDByVkRQaDJESTZqTDAxeGtMbHIyR3JXei80WGpZLzFoM04rNEJCYkRYekxuTWlTZWNGcnhtTnErVEllVnVtbGpmMGoxMW05K2JFSFBVNWkvU0VrRlBFbUZnalQvVWZRVUZiT09aeHVOMjFPS1IyeFZ1MjJ6SlVOMUJIL0w4YzV0dXNaQW44Qnd4V0d4VUdvQ21MSDd4UHJRRGhHc0JFazFERDlsalZ2TTVRa0w0WFBmNTdVL3FiR0JaQ0pJK3hxcXNrdEx5NU83NlhES3FuVTVkalZnK3V0RHo0MGoiLCJtYWMiOiJkNjRhNjIyYTcwYzMzNThiZTI4ODhjZjgyNDU1OTUxYWM3ZjM1ZmVlNzFkNzYyNmI2MGMzMThmOGI3ZDBjZjhjIiwidGFnIjoiIn0%3D\"],\"host\":[\"gestion.mobi-nardo.com\"],\"referer\":[\"https:\\/\\/gestion.mobi-nardo.com\\/store\\/my-store\"],\"user-agent\":[\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/139.0.0.0 Safari\\/537.36\"],\"x-forwarded-for\":[\"160.166.9.9\"],\"sec-ch-ua\":[\"\\\"Not;A=Brand\\\";v=\\\"99\\\", \\\"Google Chrome\\\";v=\\\"139\\\", \\\"Chromium\\\";v=\\\"139\\\"\"],\"sec-ch-ua-mobile\":[\"?0\"],\"sec-ch-ua-platform\":[\"\\\"Windows\\\"\"],\"upgrade-insecure-requests\":[\"1\"],\"sec-fetch-site\":[\"same-origin\"],\"sec-fetch-mode\":[\"navigate\"],\"sec-fetch-user\":[\"?1\"],\"sec-fetch-dest\":[\"document\"],\"priority\":[\"u=0, i\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','Windows','Chrome','160.166.9.9','my-store',NULL,NULL,'App\\Models\\User',2,'2025-09-11 23:01:48','2025-09-11 23:01:48'),(7,'GET','[]','https://gestion.mobi-nardo.com/store/my-store','https://gestion.mobi-nardo.com/store/my-store','[]','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip, deflate, br, zstd\"],\"accept-language\":[\"en-US,en;q=0.9\"],\"cookie\":[\"cc_cookie={\\\"level\\\":[\\\"necessary\\\"],\\\"revision\\\":0,\\\"data\\\":null,\\\"rfc_cookie\\\":false}; cookie_consent_logged=1; XSRF-TOKEN=eyJpdiI6Ijh1cUhaUmg2QVBNQ3h4c0daMDJheWc9PSIsInZhbHVlIjoiWjRKUDFsZWNnRWoyeXpqLzA2WHJFdTBzRmNYMHJmZVpEZ2luejNkYlhMR3lieEE3dW5VYzZQaGNqdGdiTVlzVjc5VlB2Wmw0MWVnWFlaVjhNdUlPdEZUQ3BIRFdqa3p5UDNWakVhYlo0ZkpXb0U4U0FqYUMvNEVScHpKVnB3YTVwUVJjMmRJNkZxemdhRWU5TGNWdFJ4dGdDVmlGK1RPRTFoOGJMOWdWVW4wbi9EK0o1ZVlRNGVCamZqeHp0MEpOb2MzcjhrU3dKYXp5a2lSMWNmUUM0MDJzV0J3UGVESmR6WGt1dE93aVUzVWZKandqaTdrTVhGd0wyYkRIckpqbVBkWkFJR1RVTXpRTW12MGlxcW5tUUxhWHI0V3AzNWMrS3JPR3FaeUZLU0hlcTl1ekFJdDk4d240dDAwcHJyREYxY3M2R0NvWEd1MzF3TFJyRVdTMUJiWHRGd2JmcVV6ZnlDZ1VJL0V4Q2x2TVIwN3IyZTZaNXgzVlhZMTdkUW1jT2V0K25yVm9jV1VnK0EwVG51Wmo3NzdEV09HVE5yVXhuT2JmNVZRSTFWZEJzVkhobC9haUZRM2Jwem01RkVEL0lJWjhza0o1Sjc0ZUwvS09LeUFRNVkwSi9SK2dMV3JmVjBFS2VTOVNTTkxKUG1xVGpnQllUL2s2Qm9sZWNPNDkiLCJtYWMiOiI1N2QyNDNmOTdhNzBlMDE3YTRjYjBmMDkxMGQwYTJlMWY3YWUxMDNiZjViNGQ1ODViMWUzOGRjMjZlZGI0NDFhIiwidGFnIjoiIn0%3D; gestionmobi_nardocom_session=eyJpdiI6ImtyQmhkdVV1SzVaT1BsV2ExMHNSRUE9PSIsInZhbHVlIjoieXZ1WitVQXJHNkVpWGhSVzZYUE9oVE9EMko5ZkVMMmhvR1VZL2V5RFE1QUM3UEROeFJLMDBld0xpMUJlQlUwaCtWd251M2xZRHdYOUkvR0lxanZVc1RSeUFUVzdpWWVzSEl4K0lvNlVNMitlY2NuTFZJc1BVM0ZsblNmYi9ITmYzOEdSdTRFam1ZOUpuSWQxRU5GZnFwSWRLU2xoL3N5cDFJVDdRbzZlODExRHY0ZkRta3kxVURYcERXT09aOFFtQlN4QXh6TlBTbzJkVGZwVzhiSUdoWDV6VUNUamh0cEdhK2tYUnZobVVHRU1iQzcrdktKK04zWmttVE1EaTc2bFczeHo0MjA4NDUxbEo3NVlxL0xlT05rY2swRUVPcmdGVWxGbVdTUHQwRWNGL0M2MXhJa0JMdFJtenl2bERhUGY5NERnMWQ3alE0UVFPS2Rua1ovOTdoYW9pRzgrM3pSbnMzYUJOQ2Z0SnVoTlFyMzZtN2cvRHdoTzFqbmJxTFFTTW5MUVNzaGRBTnNNellxNElmTm9ZUnk3bjBHbldTeG91SzArczRzVEFpWGxHNzJWNkljMk15TlJZdmsybEFDV2xsbm5aSnlSeHBSdHVUSHEwK3ZIVXlZUFZUWkpGQmFoNW9wUytVNWdmcTkwR1p0S1pJaDZmckhWVitZbEJHN28iLCJtYWMiOiJlOWU0ZTQwNTk1MmMwZGUzYmZhZmI4NjM1Y2ViN2IyZjIwYWM4NmMwMjA1MWU3MWU4ZjlmYTg3ZmFiNWQ1NTZkIiwidGFnIjoiIn0%3D\"],\"host\":[\"gestion.mobi-nardo.com\"],\"referer\":[\"https:\\/\\/gestion.mobi-nardo.com\\/store\\/my-store\"],\"user-agent\":[\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/139.0.0.0 Safari\\/537.36\"],\"cache-control\":[\"max-age=0\"],\"x-forwarded-for\":[\"160.166.9.9\"],\"sec-ch-ua\":[\"\\\"Not;A=Brand\\\";v=\\\"99\\\", \\\"Google Chrome\\\";v=\\\"139\\\", \\\"Chromium\\\";v=\\\"139\\\"\"],\"sec-ch-ua-mobile\":[\"?0\"],\"sec-ch-ua-platform\":[\"\\\"Windows\\\"\"],\"upgrade-insecure-requests\":[\"1\"],\"sec-fetch-site\":[\"same-origin\"],\"sec-fetch-mode\":[\"navigate\"],\"sec-fetch-user\":[\"?1\"],\"sec-fetch-dest\":[\"document\"],\"priority\":[\"u=0, i\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','Windows','Chrome','160.166.9.9','my-store',NULL,NULL,'App\\Models\\User',2,'2025-09-11 23:20:00','2025-09-11 23:20:00'),(8,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/140.0.7339.101 Mobile/15E148 Safari/604.1','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,*\\/*;q=0.8\"],\"accept-encoding\":[\"gzip, deflate, br\"],\"accept-language\":[\"en-GB,en-US;q=0.9,en;q=0.8\"],\"cookie\":[\"XSRF-TOKEN=eyJpdiI6InllWnA2MFhnRWpWMmN2cXV1SFkyUGc9PSIsInZhbHVlIjoiQTg3OHdCbFFxQVlFakFDQnliZzN1REsyZ2J3TndjMzJZUHlaRjNtclpod3ZQbTc0SW1nRFE3bU5PeldSaEpvcFVHU1hWcWZ2K0wzUSsyalpuUkNnTUZxMkx4bGs4THcycDlhRG5Mc09TVWpkZlNjeGw2K0VJWUNWSW13QnpDRnBoNmo5TUtReTBsVDA4SHplUkxDSnhlaHpWT2ZVU3Nac1ZRSUJtSlo0WFJ2c0lPQ2ZhNG9TYTNjQ1AzY29NcnErdnJjSkp4NnNJdXhNb1JVaDB0NUdQVS8rVjlCd2FkTEFKWVVBUk9pWkdLNTlFazk3NDVtT1pOcVlyVHBaNm9GbEJhVy9zWm5SazVmellWdWRlVmRVSXJ5UzVsT3ZZMGEwcm9IcEdwQ2Fvd3NqSDlQSUpZQ1NxenREcUFyekVjUzhvbnBOZVozUjdMNGI3eXcyYVhra0xnTDFkSEt6b3E0NFV2SnFEdFFUK0poaXc5TkQyM2RLUHJ4U1RzdlBxaUFzZHZzVFRIOFBSVjNjTTlSWDJDbGpMQS9janNyMEp6MC9FTW53Q2YrQlp2akxWc0JWNmV4b3A2MFRhQU5yczM2TUc1bmxaOHIvRnBlaXhSNU1lK0w3Wjg5NnczVEdoRm16Z1NneVZyTzNUVUU1Z3pHa01Dd2kxVmp1b0NMSTFyeUciLCJtYWMiOiJhYzE5NTI3ZmVjNzEzMjkxYWNhZmE4ZGIxY2I2MWZhZTEzNzRmZGQ4YmMxY2Y3NjQ1ZWRiMjQ2MWM2ODk5Mjg5IiwidGFnIjoiIn0%3D; gestionmobi_nardocom_session=eyJpdiI6ImdOb0xXMFBEb2hXbGJPdm9BNU55WGc9PSIsInZhbHVlIjoiRGo3VHdwRDhIOTNoRkdsRTAveXNza2MrWHo2TVFKblB0N2RhaitQMTB6ZFFaU3VLT2R0eldHTmlnSGtXSVdhSzhkYXlrTGd6UklXKzNoMC9PWjdMM21PWG0yZFlHeW9rUDhmcldoSFBPaUVUNCtFVFJBeXp1K3RzUU1KNkVibXVjK0NscSs5dnNoNTExMGtBcFZYQy9UVm5LS3lSU05tYlNSQkZmeDhxejB5QmNSc1UyMWRyTnEvbTUxSUNlOWNJZWkrLytmRDRzTnZPa0QxbnJNbjlWazY5RXEzc0xWMmM3ZlNEdHRpb0tFRjJJcFpaUWl2RHkxZFlOcmZlbGtkTllVV09FUC9NN3NmYlo3dHJ2OW9ScWxmeWkwZ0dYb1A0OFFTL3N3SDVBODJNWTFWRytjd0Z1R1JDYk1OZ0VxcUZILzZGYU1uNlBTelhjRHYzQjVtRnVWZkpOU0Q0T0tDa2hXanpVVVpVLzVOSjhObVdOam9lWGZvU1RLaHhWZVhiWDhud3ROb1J5eHo3WjVDcEtjbGhvZGlBQkgyUUI4R2J5Z2lrQ1lhVXlZbUVGMmEvTjg1Y0lCKytvaVczMnFSZ2pYMUxKU0dKYlFlSWNQd2lMNUE5dCt5bkRBRVdiSWFtSGxRWEkvMHIxR2hkeHpBVlpCbU1ZOGpRTkU0T2ZPaDYiLCJtYWMiOiI4YWE2ZDI2MTIzZjQwOGQ2MzcxMTNlOTkyYjZkNDNlNTBhZWVjNmZiMzg3Nzg0NWM4ZjE3Y2ViYzVjODgwMmZlIiwidGFnIjoiIn0%3D; cc_cookie={\\\"level\\\":[\\\"necessary\\\"],\\\"revision\\\":0,\\\"data\\\":null,\\\"rfc_cookie\\\":false}; cookie_consent_logged=1\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit\\/605.1.15 (KHTML, like Gecko) CriOS\\/140.0.7339.101 Mobile\\/15E148 Safari\\/604.1\"],\"x-forwarded-for\":[\"160.166.9.9\"],\"sec-fetch-site\":[\"none\"],\"sec-fetch-mode\":[\"navigate\"],\"sec-fetch-dest\":[\"document\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','iPhone','OS X','Chrome','160.166.9.9','my-store',NULL,NULL,'App\\Models\\User',2,'2025-09-11 23:49:19','2025-09-11 23:49:19'),(9,'GET','[]','https://gestion.mobi-nardo.com/store/my-store','https://gestion.mobi-nardo.com/store/my-store/categorie','[]','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip, deflate, br, zstd\"],\"accept-language\":[\"en-US,en;q=0.9\"],\"cookie\":[\"cc_cookie={\\\"level\\\":[\\\"necessary\\\"],\\\"revision\\\":0,\\\"data\\\":null,\\\"rfc_cookie\\\":false}; cookie_consent_logged=1; XSRF-TOKEN=eyJpdiI6InduUit0bkpqbTdYeE5MNjVMYWFFVXc9PSIsInZhbHVlIjoiWHJ2WjJpQzd4UjhZb1FkeUtxMzV5Z1dya2w5UUg1Mlg3RU1GNW16UmdwRXN2SEtnbWdGa2dLWjg2bXlWTC9mV0JwTHVXUGh0V1VTVVBFNnJpT1krTTRYc3JVYnZpeUwwYXYxd3ZSTCtSZmVJN0w4VUZOQmdDME8zSElvcGpseFpYMzM3OUZtcmM5WHhIME9qcmt4cEw5VlF5WjIvZldudlJkTHNGOS9pbnY1cnlic0FvNGZvN3o1STkvTnpGaUZYMFFKZ0IrRVBlUERWNUV4SjJZY29oNE5lR0NZeDkxSnZXQXZZY0lNSWVyc01qRC8ySGs0QnJXL3dGazQrZHEvZ2FKbVRDRElPeVpsYWt2c1d2Q3IwcDNLTWRhZ0tXY2JxeFlVV3RZMm5NREtlTWU3ZnVjVE5rK3YveHhCZGZaNWxjNk5JeTB2QmFvOXljZUVMOW9YSW1USFA3d1VoNkQ1VlRlVFZBZ0duaUZrNkJBN211WmQ2dk1QblhKUlViWU9UOVVsblVPWTV5WXhHZG9uV0NMQjI1Y0VmQ1EwVTlUSXpSQlJXM0hkaFZZMHp1aGprQW5McWttZElwWitSeDJBZWJqVkpJcWlDekNiMlhYcGJLUVhqVVA4NlZ0Z0pFMUZHa3l4N3VYa3lyb1RvbTd6bm5QUjVWMndjWkV3SmJWbTEiLCJtYWMiOiI1ZWEyM2IzNzZmYjAwNmZiN2I4MWFjMTdiMjUyMDFkZTYyMDljZjIzZjc3ZWE5YTlhOGI3NDZmNTMyMDIwMWY4IiwidGFnIjoiIn0%3D; gestionmobi_nardocom_session=eyJpdiI6IlFWUVJQVC92bUFWUEozTStlVXU3dnc9PSIsInZhbHVlIjoiSDB5YitJMm5PS3VPZGN6YXl5aVNmR2Q1aFE4MnQrcy9MUGZyN0ExbVVGTmZJSk1qOHM5bisxb3RJK0x6UnhyRW5wUXpRWC9CM1kvcDhKbFRjNUltRDU3ZG93cmJub2lLQys0b2w3T3JCTFVMQ3hpdk5nbU94WjUxOGl3K29BZXpuaUlKWFVRNW9wcXVjZ2RyemJWdWZ0aVVlWGlBTzRGM2lwR3NOVUUxOVZwN2dmbThyUVk0SjFRZDVhc1l2bmlPd0l6eitjSnBaODFCalAxanRLYXJaQWZDVUFCVTdLM1hXajROSmhpcS9UQ3JEUFNvRnV0ZGkrYUFBck9ib21VWjFvODNwTDloUkRpdENCay9HeXpDUEhVQVNSRjZyeUVwd0FSVVFQUC9YUmFBOVl2a01LY1hyRmVWUUFkOEs4SE5ZaTNIbUFSOVo4VGYzRTQ5OWpjYTNEQU5GaU44cVFqeWNvMXliWGhuYmZVNzRGTFZrQitHTWVHZjlndi96aXV5Nm5MdXJQYys1MWhIbFBtVUJpYmZkaTE0TzN4S1JuNExhWlp5eFQ0YkRDMlV0M2luWms4R0Y0RnhhOXN4dm1UYWhFdEtBdXNZWVNDaC9RN2U5eVRVb2N1d0gvT1F6ZTJuZDYvR2s4d1p5Q0RKWnZ6NlFaOXlnbFJUT3pPRnQ0NE4iLCJtYWMiOiIyY2Q1NTA0MzE5ZTYyMjVjZTI3MTg4YjUyNGY2MDU3NzMxMzE3NzllYWIzY2M0ZjcyYzVjNzQzODhhN2YzY2Q2IiwidGFnIjoiIn0%3D\"],\"host\":[\"gestion.mobi-nardo.com\"],\"referer\":[\"https:\\/\\/gestion.mobi-nardo.com\\/store\\/my-store\\/categorie\"],\"user-agent\":[\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/139.0.0.0 Safari\\/537.36\"],\"x-forwarded-for\":[\"160.166.9.9\"],\"sec-ch-ua\":[\"\\\"Not;A=Brand\\\";v=\\\"99\\\", \\\"Google Chrome\\\";v=\\\"139\\\", \\\"Chromium\\\";v=\\\"139\\\"\"],\"sec-ch-ua-mobile\":[\"?0\"],\"sec-ch-ua-platform\":[\"\\\"Windows\\\"\"],\"upgrade-insecure-requests\":[\"1\"],\"sec-fetch-site\":[\"same-origin\"],\"sec-fetch-mode\":[\"navigate\"],\"sec-fetch-user\":[\"?1\"],\"sec-fetch-dest\":[\"document\"],\"priority\":[\"u=0, i\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','Windows','Chrome','160.166.9.9','my-store',NULL,NULL,'App\\Models\\User',2,'2025-09-12 00:09:55','2025-09-12 00:09:55'),(10,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/140.0.7339.101 Mobile/15E148 Safari/604.1','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,*\\/*;q=0.8\"],\"accept-encoding\":[\"gzip, deflate, br\"],\"accept-language\":[\"en-GB,en-US;q=0.9,en;q=0.8\"],\"cookie\":[\"XSRF-TOKEN=eyJpdiI6IjNNam1ia0M4bU1POU83M0JHYmk5Smc9PSIsInZhbHVlIjoiZnN0Zjg2amRpRTF3NDBMY3lPcUFxTXpBMzN3VmwzYm9FVGY1cUZaWnRlRjlHYTBnNFdhNEdDOWtuZjNpT004R3JQSUkraTZEcjFZbndqSEs4WVZzVGU0eS9HOCtlODdhdzZGS1g3RUNKclc1Z253S3dpL0JoRnlzdmdZRW0vZ0FtazgyKzFQOExtd2hLM3BDaW5VbmN4bTBzUHRINDZMUGhycVhDVmI4WWI5ZXVCTzdXakxsbDdaQWlNaDdGODNvZ2Q3SkV5Wjdrb3N1bkRqNnR3RXYvQXBZcGZrOE9uUkNQWEhwR0o5S1hzYkpkZnFqNkpnKzMvMmdTNm9LeXBoRWJwdFhzbnAwTjFaSVMwclBPNHc0OFNhTTJwL3YzVnhvWFIyUjYzdGQ1LzdvcElPOEdoclRNcVVmb09wVHgrbmZBT0F1OWlIU2p0ZnlZMlVrQzVVOGZ1aTRvUkd1N0t1ZG9YejZxeFdMN2xmeFpWa1dVZHJVTjRqRlV6akdOSm83eG00djZUdFd0dC9Xc0s0SzZaZVZTaVE2L25BQkFmY2lTOW0rZnFpUlNqcEpydnFPTThNeWZnb2JBOHdXNXRIc2FZUngyU0VMTUhYeVQ1STI0VnZHVkUyYkQrWHByc1ppNG14WDhralJsUTZYNEJoSU9WU3hYcGdkcjluZHd0NFYiLCJtYWMiOiI0ZjE4ODRhNzMwN2ZiNDg5OTcxZmFiN2ZmN2VjYzJmMjJhMmRmNGFmNjllZWQ4MmUyYTg5NGIwOTVmNWE0MzM1IiwidGFnIjoiIn0%3D; gestionmobi_nardocom_session=eyJpdiI6IklrOGIwYW8zeTFxcVN5UkpFMlZvSUE9PSIsInZhbHVlIjoiWVdyZDVTMUtKZmVoM0RPL1M4YnBlYVI5TUVwVXpyZlJtdTZMUGwrdGhLSU9tWWE4WnljVjVYbnRzU3B2dGVoM0dpck1NUHAxaUppUTZWNGM3Mm1jeTdDakhNeEJiRWJvdFd4R2VpbFZiSkZ6NnNWczl4N3ViQ0t3MFU2aHlEV3VhMzVPMlQwZGdaSWt0M0pqOXJSbXdMd2I2MVZFSGFBQjBMWEVUbDhSVHR6bzdLQWFDaXAyUWJzOUtJRXRRbjhhd21HWEtLRHZLTjN6dFdwejJDYmpZdGFNSUxWZkd1Tk15QVdKN1lRRHdHQUZOYXdIcXB5UDRjeWszWVBsN0hNQ0lJa3RUczRCMWFWTXhwR3NTWFlTZCtxeHlKTkMzR2ZDRVQ5UnUwUmYvT082Z1lMQXRpRjRaME9OZ0ZYeEppK3YveStzMHZFZCtVdlFDMCtIMlRkaDIzRHBpcUpXQTNBZ2NvYWwwcTdwOURMU2dYSEYzbVN5Sk1la01xRFZMeG92SUx2QWlRdFdQZVJlVzY1OFBrL1Q2VWgzRkVyN2RpaXg1QkY2aHg4dnZCZkdGSVphYnZ6L3djQlNuRkxJWVRtZ0FyaXh0ZUtwa216VkIrY21ma3orNW1EMXpid3NkaU43SXJ0T1psZFdpUjBNTmV0TTA2bk9SV3dWbTQ1TEJvcWoiLCJtYWMiOiI1ZGE1NjgzMDgxODUxZGViMjAzNzRiOWJlZGMyYTQ2MzQzMzFhNWNlNmQ5ZTdhZDc4MzFlMzk2OTUxOGI3ODJhIiwidGFnIjoiIn0%3D; cc_cookie={\\\"level\\\":[\\\"necessary\\\"],\\\"revision\\\":0,\\\"data\\\":null,\\\"rfc_cookie\\\":false}; cookie_consent_logged=1\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit\\/605.1.15 (KHTML, like Gecko) CriOS\\/140.0.7339.101 Mobile\\/15E148 Safari\\/604.1\"],\"x-forwarded-for\":[\"160.166.9.9\"],\"sec-fetch-site\":[\"none\"],\"sec-fetch-mode\":[\"navigate\"],\"sec-fetch-dest\":[\"document\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','iPhone','OS X','Chrome','160.166.9.9','my-store',NULL,NULL,'App\\Models\\User',2,'2025-09-12 00:18:59','2025-09-12 00:18:59'),(11,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; MJ12bot/v1.4.8; http://mj12bot.com/)','{\"accept\":[\"text\\/html,text\\/plain,text\\/xml,text\\/*,application\\/xml,application\\/xhtml+xml,application\\/rss+xml,application\\/atom+xml,application\\/rdf+xml,application\\/php,application\\/x-php,application\\/x-httpd-php\"],\"accept-encoding\":[\"br,gzip\"],\"accept-language\":[\"en\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; MJ12bot\\/v1.4.8; http:\\/\\/mj12bot.com\\/)\"],\"x-forwarded-for\":[\"54.37.252.46\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','54.37.252.46','my-store',NULL,NULL,NULL,NULL,'2025-09-14 21:39:30','2025-09-14 21:39:30'),(12,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; MJ12bot/v1.4.8; http://mj12bot.com/)','{\"accept\":[\"text\\/html,text\\/plain,text\\/xml,text\\/*,application\\/xml,application\\/xhtml+xml,application\\/rss+xml,application\\/atom+xml,application\\/rdf+xml,application\\/php,application\\/x-php,application\\/x-httpd-php\"],\"accept-encoding\":[\"br,gzip\"],\"accept-language\":[\"en\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; MJ12bot\\/v1.4.8; http:\\/\\/mj12bot.com\\/)\"],\"x-forwarded-for\":[\"54.37.252.46\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','54.37.252.46','my-store',NULL,NULL,NULL,NULL,'2025-09-14 21:39:30','2025-09-14 21:39:30'),(13,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip, deflate, br, zstd\"],\"accept-language\":[\"en-US,en;q=0.9\"],\"cookie\":[\"cc_cookie={\\\"level\\\":[\\\"necessary\\\"],\\\"revision\\\":0,\\\"data\\\":null,\\\"rfc_cookie\\\":false}; cookie_consent_logged=1; XSRF-TOKEN=eyJpdiI6InJmV2VrQzA3YTloRkdiZERycjZERkE9PSIsInZhbHVlIjoieG1JakNPYjFzWVlQNDUvMmdwOUV0R2htRjZQcjVRYlozOWduZDlpVGZ5ejh0b3JyYlFYbHB4dGZpTzd3aDJBN2tpN2FUUEpmcE9iQnZpdWNBd2F1MFJtdk5MZmppZnNtNTlxVXdkY2xxN0plSGFJVzFXaDVIbVdVbnVMUjdET0NianJSU0l4aE5sbW5wSWd3NGpmK2pROThiRGN4aEpCRlJ2clh2a3BtRVhjREhxV3lxZ2Fvd3VnYzljYlJnT1Z4N2M1ZDdvbTlGaHhRcW5EeklEd2NhOFRxMi8wR1FIb1ZpdXBKcWtpSElmTXNFUGlsNUpVQ2NFMDBudm9aaWdLbzlsY3ppbDEwLzZ6Uis4aHY0UUJidVdZdStFMXhqUFQyMnphRStWTXErTExVZmw0QVhraDJwSXNXVWNSM1Zvem81cUVBenByWlJsNTFCaC81NlBsRXBPWnpYelRHNzBBa0hVblI0SVJtelA2a05wUE15emJFeVlzV1ZpVThvamQwZDNiaUxrRVFUbnNMbjBiU29walJDNGp4SkVSN0xSLzNFQ0VtRFIyWlpnOW8zZ0FoV29xMVpFQ0k5RERKTlV4NUc2MThTeUt6ZzRQRmkyamFpVGpib1NLcGEvTHplNXpIdnFrbUFXUS9GZTBCSnRmM2dtekZBd2hjTzl6WUZrcU8iLCJtYWMiOiI2N2VkYzJlNjBjMmNiMWMxY2QxYTNkNjczOWUyZjhjOWU0NDcwNjkyMmVjMzA3ZThkZjY4YTcxZTc4MTQyODAxIiwidGFnIjoiIn0%3D; gestionmobi_nardocom_session=eyJpdiI6InI3U1I1eXhJanJ6R1h6VnV2MnFieEE9PSIsInZhbHVlIjoidWdpMTczMjZDU2Y0NDNEMDhOdjI1UVdFNmVxZXNYblh4MHVybDI1dEtXMmRTOXptN2RzekJkOFR6VUZKK1RJK1hhcUwxK0Q5NXRpUVUwVjhFVmxHWHNleVVzdklOdjFoOTlxMGFvYnlLcGFJZnNUeWdPdlFlbmdjdkh4YXEwR1VNRzBBOTNsRm1iTE9yZ0Q4bytuMjgzWVBZMS94Q1BIWHZQUiszaVo1NFVUNDUxYitLc0VYWWlNYXZpek5GWVhiZktuc3hIdzlhRlJySWEweFBxU0hYWjVRQnExaFVaaVZXV3NRSUhCbEFETkwwQUtMalAyb3VEY2hicTZwbnJRVlA2ZTV5ZXFHd0NreWdNU3E3aXRiRVY4MEVTYitZdmNWbkxJMFcvcXphcFM1VDVxQ2hEM3U1aGV3a0xsZ3JaOUpOZ3lld0ZiQTlKTk9yWXViZk9seHlNYXJYclo1dWpMTHZCU0NJV3V1R25DbExlZEQyNXh4Z2FRb3d3dnlvQlZtUS9LUFFDVE5zNk1yWmViemxZWHI3VHQ0dTNYV2JDK0czbFV6cjBxc3hOakdYZ2RyaG5Ldyt3eHQwNW05OXRUQjNnN1BuZ1IyVWZ0T2VZdFhKVUNzUTFLOGZ6SXB0M3hrNWUreWk3clRteXRCYjFxMGdVd2VqZm14ODk4anpDVlIiLCJtYWMiOiI2ZDRkMTVmNzVlMTI0NTZhMjU5YmYzZjU1YzFjZDkzNjM0ZDEzMzY3MDhlYzg5YzgwNTg1ZDExODc5NjUyYzljIiwidGFnIjoiIn0%3D\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/140.0.0.0 Safari\\/537.36\"],\"x-forwarded-for\":[\"105.157.237.248\"],\"sec-ch-ua\":[\"\\\"Chromium\\\";v=\\\"140\\\", \\\"Not=A?Brand\\\";v=\\\"24\\\", \\\"Google Chrome\\\";v=\\\"140\\\"\"],\"sec-ch-ua-mobile\":[\"?0\"],\"sec-ch-ua-platform\":[\"\\\"Windows\\\"\"],\"upgrade-insecure-requests\":[\"1\"],\"sec-fetch-site\":[\"none\"],\"sec-fetch-mode\":[\"navigate\"],\"sec-fetch-user\":[\"?1\"],\"sec-fetch-dest\":[\"document\"],\"priority\":[\"u=0, i\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','Windows','Chrome','105.157.237.248','my-store',NULL,NULL,'App\\Models\\User',2,'2025-09-20 13:22:12','2025-09-20 13:22:12'),(14,'GET','[]','https://gestion.mobi-nardo.com/store/my-store','https://www.google.com/','[]','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip, deflate, br, zstd\"],\"accept-language\":[\"fr-FR,fr;q=0.9,en-US;q=0.8,en;q=0.7\"],\"host\":[\"gestion.mobi-nardo.com\"],\"referer\":[\"https:\\/\\/www.google.com\\/\"],\"user-agent\":[\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/139.0.0.0 Safari\\/537.36\"],\"x-forwarded-for\":[\"197.230.59.4\"],\"upgrade-insecure-requests\":[\"1\"],\"sec-ch-ua\":[\"\\\"Chromium\\\";v=\\\"139\\\", \\\"Not:A-Brand\\\";v=\\\"99\\\", \\\"Google Chrome\\\";v=\\\"139\\\"\"],\"sec-ch-ua-mobile\":[\"?0\"],\"sec-ch-ua-platform\":[\"\\\"Windows\\\"\"],\"sec-fetch-site\":[\"none\"],\"sec-fetch-mode\":[\"navigate\"],\"sec-fetch-user\":[\"?1\"],\"sec-fetch-dest\":[\"document\"],\"priority\":[\"u=0, i\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','Windows','Chrome','197.230.59.4','my-store',NULL,NULL,NULL,NULL,'2025-09-20 13:22:17','2025-09-20 13:22:17'),(15,'GET','[]','https://gestion.mobi-nardo.com/store/my-store','https://www.google.com/','[]','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip, deflate, br, zstd\"],\"accept-language\":[\"fr-FR,fr;q=0.9,en-US;q=0.8,en;q=0.7\"],\"host\":[\"gestion.mobi-nardo.com\"],\"referer\":[\"https:\\/\\/www.google.com\\/\"],\"user-agent\":[\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/139.0.0.0 Safari\\/537.36\"],\"x-forwarded-for\":[\"197.230.59.4\"],\"upgrade-insecure-requests\":[\"1\"],\"sec-ch-ua\":[\"\\\"Chromium\\\";v=\\\"139\\\", \\\"Not:A-Brand\\\";v=\\\"99\\\", \\\"Google Chrome\\\";v=\\\"139\\\"\"],\"sec-ch-ua-mobile\":[\"?0\"],\"sec-ch-ua-platform\":[\"\\\"Windows\\\"\"],\"sec-fetch-site\":[\"none\"],\"sec-fetch-mode\":[\"navigate\"],\"sec-fetch-user\":[\"?1\"],\"sec-fetch-dest\":[\"document\"],\"priority\":[\"u=0, i\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','Windows','Chrome','197.230.59.4','my-store',NULL,NULL,NULL,NULL,'2025-09-20 13:22:17','2025-09-20 13:22:17'),(16,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip, deflate, br, zstd\"],\"accept-language\":[\"en-US,en;q=0.9\"],\"cookie\":[\"cc_cookie={\\\"level\\\":[\\\"necessary\\\"],\\\"revision\\\":0,\\\"data\\\":null,\\\"rfc_cookie\\\":false}; cookie_consent_logged=1; XSRF-TOKEN=eyJpdiI6IjBhaGpMM1dZdE9hdVB4QXRTalpxZUE9PSIsInZhbHVlIjoiUm9TbFZNZ2xIcjFaa1RMcXh0Z2pralNOd0dIMzlhQzltMmlZd2ZYUEJ0UkxmMERtV2JtdTBXdDRqaUdkTVZ1clhKTVZtUFVWdTRZWVVxZXhsaUFEUmVtTmVqU0V5KzBZRzlJQmIxcFB5ZXZBcitLQUREaWM4eUpxcUl1YXJaRkcxR2kvQ3dWWjV1UklObEkrN3NzQmlKaXllUndud084bGxDTmpZdHRQRk9FeXNKWnpRSGozOGd0OUZMR1NPWW5Ic0czTy9UbzhXd2ZMVURVSFhQMERTUHA2RFB1N25OM3hJMVFScm56ekEydmhpZ2orQ3lpQURsbUNkOEJRZHhWRzNESlZFQXg4MGl5QmtkYmVuVkNUZ1FBa0s4M2ZhR1pzbmR2SzlYL1E0ejQ0MHREWWVXOHM3dm9NNWlpS1FVUlZtM1J2K2NnQktHd2U2cEZSNGZuR2VldGRqa1lORllGRG0wQmpqTS9Iek1OUTROczhhbldDV241Y2huTkhQYWtnMXlCM1UzT0lWSnNNYXQwZUQ0T2xJTWo0ajUyYzhnNkpJYmgvQVB6ZGlOd2RvM3d5cmRxRDB1d1FhclA4SGZLalhoNzlRZ2V6a1VMZnUvZE1VSTBONjNibk1XRWlsQ3N2SXdUK1dwN3JSemdDMnV3VGRub3BXZ2tUSEg4YzIyNC8iLCJtYWMiOiIwNmNhMjYxNmY3NjViMGIzZmRhODg2NjAxOTNjOWQxMjQzNTdmMmNkYWVmYzI1ZGIzOGJhYzJiMGFjYTkyNmM4IiwidGFnIjoiIn0%3D; gestionmobi_nardocom_session=eyJpdiI6IkJTeFJoRGsramxtTHhOY1U0Sldvc1E9PSIsInZhbHVlIjoiUG94QWVjbmkrckdOZGlTMC9lQ05Qam91N2xTakMzeVFrVUxqampIaFJYaHpFYUR1YjVyd3lORjNtdXRwVnhPUjVQRFpQQzdBQ01IcHBHWjhNSHdQUUVyTU9Yb1BjMmhIT3NUSm5DVS8wZFg3M2JvTnl5V3p4Zm55VzQ2U0ZEb0VITU5pbktCVmQ5UGFNVVFMY21TTUhmTDdpU0VUTUVGNG5ZTkFtLy80L0xDSktVVER5RzdaWjY0aGpwOFVjT05hM3JFMEhoVnFudjhVWjR1Szk3aHpWYVhsWkJBKzZXckM3OGt6UlR6QVJrSUg3SC9uWjhkMkJETkMwN2JBVjJlRldYa05PM2FnbVNIVEN4emRtdWZaQTlxTVJOWHlXRGNBNmR5ei9XREtNaTk1eXJ4bzJ4ck95TVBQOERveWlLOTEvT2RSNjRSeWNicmlQczI2Mi9tcTE2TnpVUmFQWUhGZ3U0RkZncHhtSHhVRVo3NFlkL2hES1BEME1wTzFOQ2JBU0xURXdkeUNQM25vRWFSUHd3MUdSYzFxMFFlc1M2SjJnTGZnMnFlajAvVVAxVXJvaDlnMWFHMXdVYkVnd0V4ZFdrR1R6T0UwbVp0R09iZkZ4MU9Ed3lsOE5YRVNuMytnRkNMcG5kVjkyaDdPRTFua3JOMG1PMkFDMlpQdkRqZVMiLCJtYWMiOiIzZmQ0YTdiMzIxYThjZTE3YTZmMGY2NjIzMmI2NGVhZjYyODNiYzEyODg1OTliNmM2YTdiYTNhZmRmNjYxM2IyIiwidGFnIjoiIn0%3D\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/140.0.0.0 Safari\\/537.36\"],\"x-forwarded-for\":[\"105.157.237.248\"],\"sec-ch-ua\":[\"\\\"Chromium\\\";v=\\\"140\\\", \\\"Not=A?Brand\\\";v=\\\"24\\\", \\\"Google Chrome\\\";v=\\\"140\\\"\"],\"sec-ch-ua-mobile\":[\"?0\"],\"sec-ch-ua-platform\":[\"\\\"Windows\\\"\"],\"upgrade-insecure-requests\":[\"1\"],\"sec-fetch-site\":[\"none\"],\"sec-fetch-mode\":[\"navigate\"],\"sec-fetch-user\":[\"?1\"],\"sec-fetch-dest\":[\"document\"],\"priority\":[\"u=0, i\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','Windows','Chrome','105.157.237.248','my-store',NULL,NULL,'App\\Models\\User',2,'2025-09-20 13:35:14','2025-09-20 13:35:14'),(17,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"54.39.0.94\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','54.39.0.94','my-store',NULL,NULL,NULL,NULL,'2025-10-03 03:25:48','2025-10-03 03:25:48'),(18,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"51.222.95.227\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','51.222.95.227','my-store',NULL,NULL,NULL,NULL,'2025-10-09 10:32:16','2025-10-09 10:32:16'),(19,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"142.44.233.159\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','142.44.233.159','my-store',NULL,NULL,NULL,NULL,'2025-10-15 22:16:35','2025-10-15 22:16:35'),(20,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; SemrushBot/7~bl; +http://www.semrush.com/bot.html)','{\"accept\":[\"text\\/html, application\\/rss+xml, application\\/atom+xml, text\\/xml, text\\/rss+xml, application\\/xhtml+xml\"],\"accept-encoding\":[\"gzip,deflate\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; SemrushBot\\/7~bl; +http:\\/\\/www.semrush.com\\/bot.html)\"],\"x-forwarded-for\":[\"185.191.171.3\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','185.191.171.3','my-store',NULL,NULL,NULL,NULL,'2025-10-18 08:06:07','2025-10-18 08:06:07'),(21,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"54.38.147.35\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','54.38.147.35','my-store',NULL,NULL,NULL,NULL,'2025-10-22 03:04:22','2025-10-22 03:04:22'),(22,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"54.38.147.254\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','54.38.147.254','my-store',NULL,NULL,NULL,NULL,'2025-10-22 13:06:43','2025-10-22 13:06:43'),(23,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.2; +https://openai.com/gptbot)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"gzip, br, deflate\"],\"cookie\":[\"XSRF-TOKEN=eyJpdiI6IlluTzA3MVdOVzdsSG8zd3lSa1ovSnc9PSIsInZhbHVlIjoiaHM4V3NId1MvclhZUndjczhWQlFHUk12V1NDMUZWa05vKzc4Qms2Z1M3eEF0MTZLYUlLT29WNk53UE4xRndpR3BkYnR1UE9FaWhOWkR4TzRFWWhIMTBrSzMzU2JqUitEQmtHbXZIRnQ2MEZuRldEcUZoeVlwZFlqUHdTNmtnWEQzUnJ3cTBkTjhodnFCbHZTOVlmaStaZmJhTzg4Tm5rVDY3SlFyckZDKzBTbUMydGMvY3N3Snh2MXczMkhhZit0eFRXQ0gvV2pmZWZpYWpLL2ZjN0p6OTc2RjRUMUVnMmZnd1N1cWE5Zmt0QVN1T3JsZHo0WXJNUm9uQmZHOGlqMU10L0pvc1M0azRYMkNvM280dzNEN2poN0gvTDJ1Yk1yaW0rWGlHSko1eDVkTEVNeVpHaStLRk9TTWJPWjZibVAxUUpsaVM3RnNLWWJXenIyQUVVR0RHY05yQnJaY0N5a0hLTVVUMkQyWVNTQlo2ZXQyZVhFY0pSK1dkbzZYSUJJU09RcWsyMHg5RER1dUlBRG5jcUpUYXZOL0J3cnJ0M2ZyMEtITzQ4RGZURmdTbmdCZHpCUE51K1MvUXNNcmRBWmdSd3N1RWFkSWdMUlkrOFk4MWJtVDFOc3QvcnJMMFZzWWRXVWVVREhGc21BblpMaGxGRS91RU9Zdit4NW93NjAiLCJtYWMiOiJjNTE3YjgyNTFiNzZhOTZiZjQ5YzkxZjFiOTZkMTYyYzFlZDc1NzgyNDQ5YjAzMjE5NTdmZGZiYTYwMDEwZmVjIiwidGFnIjoiIn0%3D; gestionmobi_nardocom_session=eyJpdiI6IlRMQXpqMDZJdHhMYXBWMGs4YzNkVnc9PSIsInZhbHVlIjoiZitBUE40dkFVcmRhR3hhM0JsMkxDWGZWZGpsWWxPbnpUVDdRWXJzejhUWllSRSt5d3hDZkNoM1NSays5dUVyUElubk5KQ3NySUtRSDdXQ0RPcUlEb2dzdjZXRHgvQ0tGUDV3c1JyaWZiR1dwVDBsVkxwRnBKMkNBemd3QzMzTHZrKzRlZ2RMNkhCYncxV1Y0OEYrSFdXelhaYWtqNkZkM29UcG9YcldIZVdYdkQzZU1YRGZQSk1KcU95eExmVG9EMTYzK2JJN2pFbzdycEYwMytLTnJuY3lnMFJmMDdKazJXVmxnWFNjaFgzc1pFMnBVQ3ppM0wwRHhTT3FwQjVRWXY0Vm53MlE4dmlIVlZ2M1VaTEFNUGNad0t2M1lKTWdubFJPVUM3dE16WWRjTHlERE1lY3lJdTJJcEh6eU9JM1MrSVRrbEV3WkdkRVljT3ExTVdwaXlwblBCVlN3a1VUYzREV3RmeE5MNnAyOTBiLys2SnQ0QjJxb3YwQWo1bUM0N04zNWx2NmJGMVdDYktVQ0ZaU3JSaVF5eTI0bXU3MmpMLzBYZlRPZC9oeWdYaXdMVnVHUGU4OG11azFqbVRkcnhJSDNYLzlucmZqRE9mTkhYVkhrM21LV21iZkFsOW9KYW1RV0tUbzFycUhreksvYzVQLzRKS2lPL0xPczhDYy8iLCJtYWMiOiJhZDZmNDAzZWE3MDkwYTA1MWUxYTMwN2IxZmUyZTEzNmRkNmZiMjNkMjI0OTk0YmNmNjBiNDE1OTY3MTJmNjIzIiwidGFnIjoiIn0%3D\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 AppleWebKit\\/537.36 (KHTML, like Gecko; compatible; GPTBot\\/1.2; +https:\\/\\/openai.com\\/gptbot)\"],\"x-forwarded-for\":[\"20.171.207.92\"],\"x-openai-host-hash\":[\"841027007\"],\"from\":[\"gptbot(at)openai.com\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','20.171.207.92','my-store',NULL,NULL,NULL,NULL,'2025-10-27 16:51:21','2025-10-27 16:51:21'),(24,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"51.195.183.63\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','51.195.183.63','my-store',NULL,NULL,NULL,NULL,'2025-10-28 17:17:47','2025-10-28 17:17:47'),(25,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.2; +https://openai.com/gptbot)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"gzip, br, deflate\"],\"cookie\":[\"gestionmobi_nardocom_session=eyJpdiI6ImFRZlVhN1RKbFE0ektsaWlIcmVXdVE9PSIsInZhbHVlIjoiUThNZnR5RjNGV21VNzM1aDVsWTMxaHFzZXdwSGF3eGNocjJDdnBXYTltaUJIWFhCNGpqeWxQa2lSZ0ZYZ3h3RnAxaS9hQ3Y0R0sweHRhMWt0cnFCOW9CSGNtOFZ2ekZNeDlHUGpiK2ZXbGFxKzlIcVhHZEdRbks0a0Z0RnpwRElFbkZiMHFJaTNiaG5BaTV3eEtUaWJ6OW5wcmxWcXA1QmpCUFVHb2R2TTdLMjZIb3hwenB6ckZFOTZPZWpWUXZ3eHFaVXYvSG9YbmdIcjkrcllOaG9HZ29BR3FZU1VEUG1JSmExWmJuUUJNTDl0NjhoTEJHT3lKSjlxRjZ6UzF0TTV0VHFzbmxpdkgrQzBjaXMxc0t5dUlnZDJYZjFPdDV6d0pXbi9BOTBtYzBWb0JVMXJ6SS91WEJTVUlhekttTzhnYXFnOFFoWDZhWWoxOTRkcjRheUZnQXFJQ1hiNHU0R1J6VjhvMzRVYi8zQTBCckJDV2VYRms5Q0xnUFV4OVRWMHdiYkRHeE9TSVhtSTZIZ3dRWFovVEM0YlFLQW5iU0NIbHJ0d3UyRysxa09RSzZKck92NUZKcjErbkRxd0c5UXdIN1F2YW8vYmRCRDNVb0xPSTNvdnhNN2JCNVpNN3dMcXozSXZocmNRN2IraHVxVkk5Z3BxUUhWS3A5M3d1dk8iLCJtYWMiOiJkZTcxNzI5YWQzZjBmNGQ3MDVjYjRmYTZjNjIxNjYzYjhmNGY3MzZmYjJiNDNlOGY1ZDVkNDI3OWU0ZjlkM2Y0IiwidGFnIjoiIn0%3D; XSRF-TOKEN=eyJpdiI6IlFvamhRTDNUNmRhMUZsakdNc2lvTkE9PSIsInZhbHVlIjoielBycnB3cFBReVhLRFBmd2J2Zit6YW0vM1V4YkRWTk5pM1lya09nVlVmbXY3V1hmMFRQMzRvMFBhOTNTeUtXUjdrRkl2RnJhd29vaHNxZWdldVgxTHJMWERiM28wSmE2UHRPaDhLekgvSHgrcDBZSzA4Q0FWQUdMNjJxU3pkcDJFeHM0TG9ra0IzcmJ4dFRRWTNORzh2TFBQTms4OVRJVFV3YVlQNHBUc3NSclgzdmY3R3Q0ZmxSTlMwSXlycWxCQ09xWkxidG9uU3hVMWxmdzk4QjdmOGhYYVVHU21vc1VNZURoM0pQSmZnLzRZR09vdG9HSkphYnZUa0h4aXgvSGk2aEw1VVZGYUplKzJ3ZTlqSGc4czJSVXpoeEFNYzNZbnhxNkJFTzE2enB1TGx6V3ZPWC9qVENXeVRZZ2lCUU5RM29Nb2ZQUVg4MEpvN0FRcUplTUR2ZTIyVmJxYzlybXFmZEJpWkp5QzI0KzkydWpEZ1Y2OFFNZEMvOCtveFB0SzJWbVV4WmlINGF5SnFZQkFZUUZxUG41R2x2NjRxMHIxcHcySkJjRXU0MUhocTZ5dHB0ZGFSSGpLZUtrZ2l3Ky85TTRDNEtEU2hVSklLc2hmc1hIdXFzdXBmT2FTSksyTkNCSW4yVkZMa3FkT1FKREdOcVRhdXVCUmFPajhEZWQiLCJtYWMiOiJlNjM1ZGEwYzhhNmViZGE3YjUzYzg4NjM4ZWQwMDcxYTlhYzYzZWI0Y2JmZGYwM2JhNjkwMGE4MWQxZTRiMDdlIiwidGFnIjoiIn0%3D\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 AppleWebKit\\/537.36 (KHTML, like Gecko; compatible; GPTBot\\/1.2; +https:\\/\\/openai.com\\/gptbot)\"],\"x-forwarded-for\":[\"74.7.227.157\"],\"x-openai-host-hash\":[\"841027007\"],\"from\":[\"gptbot(at)openai.com\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','74.7.227.157','my-store',NULL,NULL,NULL,NULL,'2025-10-31 15:28:37','2025-10-31 15:28:37'),(26,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"198.244.226.164\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','198.244.226.164','my-store',NULL,NULL,NULL,NULL,'2025-11-05 08:44:50','2025-11-05 08:44:50'),(27,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"54.38.147.199\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','54.38.147.199','my-store',NULL,NULL,NULL,NULL,'2025-11-05 16:43:04','2025-11-05 16:43:04'),(28,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"198.244.240.179\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','198.244.240.179','my-store',NULL,NULL,NULL,NULL,'2025-11-06 00:05:17','2025-11-06 00:05:17'),(29,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"51.195.183.254\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','51.195.183.254','my-store',NULL,NULL,NULL,NULL,'2025-11-06 14:46:05','2025-11-06 14:46:05'),(30,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"167.114.139.140\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','167.114.139.140','my-store',NULL,NULL,NULL,NULL,'2025-11-07 00:43:44','2025-11-07 00:43:44'),(31,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"142.44.220.87\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','142.44.220.87','my-store',NULL,NULL,NULL,NULL,'2025-11-07 07:10:27','2025-11-07 07:10:27'),(32,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"15.235.27.13\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','15.235.27.13','my-store',NULL,NULL,NULL,NULL,'2025-11-13 13:31:49','2025-11-13 13:31:49'),(33,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; SemrushBot/7~bl; +http://www.semrush.com/bot.html)','{\"accept\":[\"text\\/html, application\\/rss+xml, application\\/atom+xml, text\\/xml, text\\/rss+xml, application\\/xhtml+xml\"],\"accept-encoding\":[\"gzip,deflate\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; SemrushBot\\/7~bl; +http:\\/\\/www.semrush.com\\/bot.html)\"],\"x-forwarded-for\":[\"185.191.171.16\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','185.191.171.16','my-store',NULL,NULL,NULL,NULL,'2025-11-17 09:03:08','2025-11-17 09:03:08'),(34,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"51.222.168.176\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','51.222.168.176','my-store',NULL,NULL,NULL,NULL,'2025-11-19 19:30:31','2025-11-19 19:30:31'),(35,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip\"],\"accept-language\":[\"zh-CN,zh;q=0.9,en-US;q=0.8,en;q=0.7\"],\"host\":[\"gestion.mobi-nardo.com\"],\"pragma\":[\"no-cache\"],\"user-agent\":[\"Mozilla\\/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit\\/605.1.15 (KHTML, like Gecko) Version\\/13.0.3 Mobile\\/15E148 Safari\\/604.1\"],\"cache-control\":[\"no-cache\"],\"x-forwarded-for\":[\"43.153.48.240\"],\"upgrade-insecure-requests\":[\"1\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','iPhone','OS X','Safari','43.153.48.240','my-store',NULL,NULL,NULL,NULL,'2025-11-23 02:21:53','2025-11-23 02:21:53'),(36,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"142.44.225.255\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','142.44.225.255','my-store',NULL,NULL,NULL,NULL,'2025-11-25 20:34:20','2025-11-25 20:34:20'),(37,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"167.114.139.104\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','167.114.139.104','my-store',NULL,NULL,NULL,NULL,'2025-12-02 01:09:20','2025-12-02 01:09:20'),(38,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip\"],\"accept-language\":[\"zh-CN,zh;q=0.9,en-US;q=0.8,en;q=0.7\"],\"host\":[\"gestion.mobi-nardo.com\"],\"pragma\":[\"no-cache\"],\"user-agent\":[\"Mozilla\\/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit\\/605.1.15 (KHTML, like Gecko) Version\\/13.0.3 Mobile\\/15E148 Safari\\/604.1\"],\"cache-control\":[\"no-cache\"],\"x-forwarded-for\":[\"49.51.52.250\"],\"upgrade-insecure-requests\":[\"1\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','iPhone','OS X','Safari','49.51.52.250','my-store',NULL,NULL,NULL,NULL,'2025-12-02 23:53:36','2025-12-02 23:53:36'),(39,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; MJ12bot/v1.4.8; http://mj12bot.com/)','{\"accept\":[\"text\\/html,text\\/plain,text\\/xml,text\\/*,application\\/xml,application\\/xhtml+xml,application\\/rss+xml,application\\/atom+xml,application\\/rdf+xml,application\\/php,application\\/x-php,application\\/x-httpd-php\"],\"accept-encoding\":[\"br\"],\"accept-language\":[\"en\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; MJ12bot\\/v1.4.8; http:\\/\\/mj12bot.com\\/)\"],\"x-forwarded-for\":[\"95.91.110.210\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','95.91.110.210','my-store',NULL,NULL,NULL,NULL,'2025-12-04 03:04:35','2025-12-04 03:04:35'),(40,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip\"],\"accept-language\":[\"zh-CN,zh;q=0.9,en-US;q=0.8,en;q=0.7\"],\"host\":[\"gestion.mobi-nardo.com\"],\"pragma\":[\"no-cache\"],\"user-agent\":[\"Mozilla\\/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit\\/605.1.15 (KHTML, like Gecko) Version\\/13.0.3 Mobile\\/15E148 Safari\\/604.1\"],\"cache-control\":[\"no-cache\"],\"x-forwarded-for\":[\"170.106.163.84\"],\"upgrade-insecure-requests\":[\"1\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','iPhone','OS X','Safari','170.106.163.84','my-store',NULL,NULL,NULL,NULL,'2025-12-08 02:40:52','2025-12-08 02:40:52'),(41,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"148.113.130.77\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','148.113.130.77','my-store',NULL,NULL,NULL,NULL,'2025-12-08 04:03:23','2025-12-08 04:03:23'),(42,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','panscient.com','{\"accept\":[\"text\\/*, text\\/html\"],\"accept-encoding\":[\"gzip, deflate\"],\"accept-language\":[\"en\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"panscient.com\"],\"x-forwarded-for\":[\"84.239.45.146\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','','84.239.45.146','my-store',NULL,NULL,NULL,NULL,'2025-12-08 16:33:51','2025-12-08 16:33:51'),(43,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','panscient.com','{\"accept\":[\"text\\/*, text\\/html\"],\"accept-encoding\":[\"gzip, deflate\"],\"accept-language\":[\"en\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"panscient.com\"],\"x-forwarded-for\":[\"84.239.45.146\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','','84.239.45.146','my-store',NULL,NULL,NULL,NULL,'2025-12-08 16:34:15','2025-12-08 16:34:15'),(44,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','panscient.com','{\"accept\":[\"text\\/*, text\\/html\"],\"accept-encoding\":[\"gzip, deflate\"],\"accept-language\":[\"en\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"panscient.com\"],\"x-forwarded-for\":[\"84.239.45.146\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','','84.239.45.146','my-store',NULL,NULL,NULL,NULL,'2025-12-08 16:34:20','2025-12-08 16:34:20'),(45,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip\"],\"accept-language\":[\"zh-CN,zh;q=0.9,en-US;q=0.8,en;q=0.7\"],\"host\":[\"gestion.mobi-nardo.com\"],\"pragma\":[\"no-cache\"],\"user-agent\":[\"Mozilla\\/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit\\/605.1.15 (KHTML, like Gecko) Version\\/13.0.3 Mobile\\/15E148 Safari\\/604.1\"],\"cache-control\":[\"no-cache\"],\"x-forwarded-for\":[\"43.130.9.111\"],\"upgrade-insecure-requests\":[\"1\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','iPhone','OS X','Safari','43.130.9.111','my-store',NULL,NULL,NULL,NULL,'2025-12-10 17:41:15','2025-12-10 17:41:15'),(46,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"142.44.233.203\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','142.44.233.203','my-store',NULL,NULL,NULL,NULL,'2025-12-14 01:59:51','2025-12-14 01:59:51'),(47,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; SemrushBot/7~bl; +http://www.semrush.com/bot.html)','{\"accept\":[\"text\\/html, application\\/rss+xml, application\\/atom+xml, text\\/xml, text\\/rss+xml, application\\/xhtml+xml\"],\"accept-encoding\":[\"gzip,deflate\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; SemrushBot\\/7~bl; +http:\\/\\/www.semrush.com\\/bot.html)\"],\"x-forwarded-for\":[\"85.208.96.196\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','85.208.96.196','my-store',NULL,NULL,NULL,NULL,'2025-12-15 00:12:07','2025-12-15 00:12:07'),(48,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"gzip, br, deflate\"],\"cookie\":[\"XSRF-TOKEN=eyJpdiI6IlpCcVNuR0xDWlY2TjRlQnpNZVZvOUE9PSIsInZhbHVlIjoiWHJyZkNsS3RGL05TaFFLWXB3eTh3UksvbXc5OTlqQi9UWm0vRlB5KzZlTlJpWVYrMEhDMnhSR0xBdkQ4QnAxL1lyTVV6WlJEaVhxQ1lUeGJ6VHQ4UnowOTExcFoyVHJORjFCTzZTNkhHa2c3TkVMbXlDL1VYSHBXaEVkSk5rNUZ2NHJwalFwTzg2TGJIQmhzZHJJalhZOU8wOSszUGZaYjY5TzR5bWxHVkk5dVZHaDdVMjYvVExoYXFmOXJORXBhRStIeXVhZk5BaWN1azQxcUgzTUdudVJlRzZQbEl3alk5UlZIUU9YbmZGR29KbE9BcjBqRGtwd0hla2JLTVBZQzgxQmJGb2tQZE5OM0ViUlBFUktQVDZmVjFSSWFCK3FBVEhZcEJFVFM4Y0NMeFdjUG8rV29FbmhuMlhlanBoTDM4OTZRWVNlSjdJS2JKcjhpOGxWTjRhUm9RTCtTVTJZcmloK2gvK2dSSHhYZXBONDZ5MmpBQjVReXYyK0pqb2x2MktwYzcwSm91NmlDOHdGNnQzUU1Jc3hqeDRybXUvQS81WVBCNDloY0lEVWRsMHp0Mkx3K0VRR1pmeExFV0xTdXp6VHR2ZEc0bndWOXNvZXY0bTRqdDg0ZlNRVm0va2tNcUtBN2JYYlJiUFNVcWZkc211OHZOcmVOQStkZVlYeUEiLCJtYWMiOiIyNzUxOTE5MjQ0ZjFjOGYxMWQ5NWU5YTg1MjQ1MzY4ZmNkNGY4ZTNjM2MzMTkzYjAwNDYzMmI0ZDk3NGFhZjc4IiwidGFnIjoiIn0%3D; gestionmobi_nardocom_session=eyJpdiI6InBWMUFsaW5UUkk2SGhZeWU3VXhaVUE9PSIsInZhbHVlIjoiTlhSNHdXQWsxZzNvUjNZdzNXa2xZb0ZiLzdKWWRxNGFteWJFL295M3UxNjgvcGVnVUpYdjZyeWpRbkgwMGx4b0lTVHl2QjZPUjY4L09vOEpuMlZwSjRkaTg0ZzkrRVFCT1plR2ZJcnEraWNndXlkL2tkREZTS290Sy9Tbm9GWkpHVmRxZktiVEpUWkZsYXBtcVlzcGhCdTdESHhCMzg3MnJKM0RSRjJha1c4eXdKSmpVZzRIY2FhQU4wWWt4KzE5d3pmaVlOQzdCZTV5eXh2bjdWS3BWMHJzVnl2Wlh3UC9ieE5DWnEwd3c1eTVIb29pS2RHbC8yYjVVN0dvcHB4UkQ2dFRWc2t1cDBZZERCY0oxMTA4a3RvQlV1REZzcUE5S05YTGVGeUtFYk1lQzVrUDdZQ3VDUGUzUVA3VmNuRS9BL3diK0VzaE1nRVdHWEdqRlQ5T0NDRzNsOWh1ODlsckJ3dWNSY096NVBpalNqZ3M2M1pwSUREUFo1alN0VC9xNXdZdmRBZDJzOEZRNk9OdFQ1a2d5eVFwU3h3cmVaSy9LWGRxdTVXOHpZSXk1WW5adFQ1S2hsakQxWHRjRHFuNUhmSkxydmg0TmVOWXBrTitvbnppV3RhZGhWUzhrbXV4VmdQeGs1RHgyZkNtSkFDaDkzcmlRcFVoZnBOdmJJcHAiLCJtYWMiOiJmMWY2OWVkNDY3ZjUxMWI5ODA0ZTFkMGQwZDYxYTdlYzgyNzVhZDczNDZkYTUxMDcwYWY2NzM1MGRmYWMxZTBlIiwidGFnIjoiIn0%3D\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 AppleWebKit\\/537.36 (KHTML, like Gecko; compatible; GPTBot\\/1.3; +https:\\/\\/openai.com\\/gptbot)\"],\"x-forwarded-for\":[\"74.7.227.52\"],\"x-openai-host-hash\":[\"841027007\"],\"from\":[\"gptbot(at)openai.com\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','74.7.227.52','my-store',NULL,NULL,NULL,NULL,'2025-12-15 01:55:13','2025-12-15 01:55:13'),(49,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"142.44.228.172\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','142.44.228.172','my-store',NULL,NULL,NULL,NULL,'2025-12-20 02:16:42','2025-12-20 02:16:42'),(50,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip\"],\"accept-language\":[\"zh-CN,zh;q=0.9,en-US;q=0.8,en;q=0.7\"],\"host\":[\"gestion.mobi-nardo.com\"],\"pragma\":[\"no-cache\"],\"user-agent\":[\"Mozilla\\/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit\\/605.1.15 (KHTML, like Gecko) Version\\/13.0.3 Mobile\\/15E148 Safari\\/604.1\"],\"cache-control\":[\"no-cache\"],\"x-forwarded-for\":[\"43.159.138.217\"],\"upgrade-insecure-requests\":[\"1\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','iPhone','OS X','Safari','43.159.138.217','my-store',NULL,NULL,NULL,NULL,'2025-12-20 08:00:06','2025-12-20 08:00:06'),(51,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"54.39.6.172\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','54.39.6.172','my-store',NULL,NULL,NULL,NULL,'2025-12-26 07:12:11','2025-12-26 07:12:11'),(52,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"54.39.203.9\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','54.39.203.9','my-store',NULL,NULL,NULL,NULL,'2026-01-01 05:58:24','2026-01-01 05:58:24'),(53,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','{\"accept\":[\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\"],\"accept-encoding\":[\"gzip\"],\"accept-language\":[\"zh-CN,zh;q=0.9,en-US;q=0.8,en;q=0.7\"],\"host\":[\"gestion.mobi-nardo.com\"],\"pragma\":[\"no-cache\"],\"user-agent\":[\"Mozilla\\/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit\\/605.1.15 (KHTML, like Gecko) Version\\/13.0.3 Mobile\\/15E148 Safari\\/604.1\"],\"cache-control\":[\"no-cache\"],\"x-forwarded-for\":[\"43.155.157.239\"],\"upgrade-insecure-requests\":[\"1\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','iPhone','OS X','Safari','43.155.157.239','my-store',NULL,NULL,NULL,NULL,'2026-01-03 09:24:28','2026-01-03 09:24:28'),(54,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"142.44.220.51\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','142.44.220.51','my-store',NULL,NULL,NULL,NULL,'2026-01-07 01:56:45','2026-01-07 01:56:45'),(55,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; MJ12bot/v1.4.8; http://mj12bot.com/)','{\"accept\":[\"text\\/html,text\\/plain,text\\/xml,text\\/*,application\\/xml,application\\/xhtml+xml,application\\/rss+xml,application\\/atom+xml,application\\/rdf+xml,application\\/php,application\\/x-php,application\\/x-httpd-php\"],\"accept-encoding\":[\"br,gzip\"],\"accept-language\":[\"en\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; MJ12bot\\/v1.4.8; http:\\/\\/mj12bot.com\\/)\"],\"x-forwarded-for\":[\"81.167.26.57\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','81.167.26.57','my-store',NULL,NULL,NULL,NULL,'2026-02-22 04:33:20','2026-02-22 04:33:20'),(56,'GET','[]','https://gestion.mobi-nardo.com/store/my-store',NULL,'[]','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','{\"accept\":[\"*\\/*\"],\"accept-encoding\":[\"deflate, gzip, br, zstd\"],\"host\":[\"gestion.mobi-nardo.com\"],\"user-agent\":[\"Mozilla\\/5.0 (compatible; AhrefsBot\\/7.0; +http:\\/\\/ahrefs.com\\/robot\\/)\"],\"x-forwarded-for\":[\"54.39.210.113\"],\"x-forwarded-proto\":[\"https\"],\"x-https\":[\"on\"]}','','','Mozilla','54.39.210.113','my-store',NULL,NULL,NULL,NULL,'2026-02-23 02:53:01','2026-02-23 02:53:01');
/*!40000 ALTER TABLE `visitor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `webhooks`
--

DROP TABLE IF EXISTS `webhooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `webhooks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `module` longtext NOT NULL,
  `method` text NOT NULL,
  `url` text NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webhooks`
--

LOCK TABLES `webhooks` WRITE;
/*!40000 ALTER TABLE `webhooks` DISABLE KEYS */;
/*!40000 ALTER TABLE `webhooks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-26 15:09:23
