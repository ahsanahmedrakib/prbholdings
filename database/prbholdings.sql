-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: prbholdings
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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'PRB Administrator','admin@prbholdingsbd.com','$2y$12$9aqiGEh97Pe818j3WGOtQ.y4h8rNPqOtNkMR9UO4YpaMjh..hev5G',NULL,'2026-11-12 12:32:46','2026-11-12 12:32:46');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amenities`
--

DROP TABLE IF EXISTS `amenities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amenities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'sparkles',
  `description` varchar(255) DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amenities`
--

LOCK TABLES `amenities` WRITE;
/*!40000 ALTER TABLE `amenities` DISABLE KEYS */;
INSERT INTO `amenities` VALUES (1,'24/7 Monitored Security','shield','CCTV coverage, guard posts and controlled access at every entry.',1,1,'2026-11-12 12:32:46','2026-11-12 12:32:46'),(2,'Dedicated Car Parking','car','Generous parking with organised driveways and 24/7 monitoring.',2,1,'2026-11-12 12:32:46','2026-11-12 12:32:46'),(3,'Standby Generator','bolt','Uninterrupted power for lifts, lights and everyday essentials.',3,1,'2026-11-12 12:32:46','2026-11-12 12:32:46'),(4,'Community Spaces','users','Reception, caretaker and community rooms that bring neighbours together.',4,1,'2026-11-12 12:32:46','2026-11-12 12:32:46'),(5,'Green Living','leaf','Landscaped edges, planted balconies and naturally ventilated homes.',5,1,'2026-11-12 12:32:46','2026-11-12 12:32:46'),(6,'Prime Connectivity','map','Minutes from schools, hospitals, metro stations and Uttara\'s main roads.',6,1,'2026-11-12 12:32:46','2026-11-12 12:32:46'),(7,'Professional Care','tools','On-site caretaking and proactive building maintenance all year round.',7,1,'2026-11-12 12:32:46','2026-11-12 12:32:46'),(8,'Designed for Light','sun','Thoughtful orientations and open layouts that maximise daylight.',8,1,'2026-11-12 12:32:46','2026-11-12 12:32:46');
/*!40000 ALTER TABLE `amenities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('prb-holdings-cache-5c785c036466adea360111aa28563bfd556b5fba','i:1;',1794489031),('prb-holdings-cache-5c785c036466adea360111aa28563bfd556b5fba:timer','i:1794489031;',1794489031);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_messages_project_id_foreign` (`project_id`),
  CONSTRAINT `contact_messages_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hero_slides`
--

DROP TABLE IF EXISTS `hero_slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hero_slides` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `eyebrow` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `cta_label` varchar(255) DEFAULT NULL,
  `cta_url` varchar(255) DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hero_slides`
--

LOCK TABLES `hero_slides` WRITE;
/*!40000 ALTER TABLE `hero_slides` DISABLE KEYS */;
INSERT INTO `hero_slides` VALUES (1,'Now Open · PRB Shirin Garden','Your satisfaction is our dream.','Spacious three-bedroom residences in Diabari, Uttara — crafted for the way you live today.','uploads/projects/shirin-garden/hero.jpg','Explore Shirin Garden','/projects/shirin-garden',1,1,'2026-11-12 12:32:46','2026-11-12 12:32:46'),(2,'PRB Brothers Garden','A home that grows with you.','Twenty-one exclusive apartments in Kosaibari, Uttara with efficient layouts and 24/7 care.','uploads/projects/brothers-garden/hero.jpg','Discover Brothers Garden','/projects/brothers-garden',2,1,'2026-11-12 12:32:46','2026-11-12 12:32:46'),(3,'PRB Shiri Serenity','Serenity, by design.','South-facing apartments in Kamarpara, Uttara where every morning begins with natural light.','uploads/projects/shiri-serenity/hero.jpg','View Shiri Serenity','/projects/shiri-serenity',3,1,'2026-11-12 12:32:46','2026-11-12 12:32:46'),(4,'PRB Naima Palace','Palace living, every day.','Expansive family homes on Gawair Madrasha Road, Dakshinkhan — designed around togetherness.','uploads/projects/naima-palace/hero.jpg','Explore Naima Palace','/projects/naima-palace',4,1,'2026-11-12 12:32:46','2026-11-12 12:32:46');
/*!40000 ALTER TABLE `hero_slides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_11_12_000001_create_settings_table',1),(5,'2026_11_12_000002_create_admins_table',1),(6,'2026_11_12_000003_create_hero_slides_table',1),(7,'2026_11_12_000004_create_projects_table',1),(8,'2026_11_12_000005_create_project_images_table',1),(9,'2026_11_12_000006_create_testimonials_table',1),(10,'2026_11_12_000007_create_amenities_table',1),(11,'2026_11_12_000008_create_contact_messages_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_images`
--

DROP TABLE IF EXISTS `project_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned NOT NULL,
  `image` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'gallery',
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_images_project_id_foreign` (`project_id`),
  CONSTRAINT `project_images_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_images`
--

LOCK TABLES `project_images` WRITE;
/*!40000 ALTER TABLE `project_images` DISABLE KEYS */;
INSERT INTO `project_images` VALUES (1,1,'uploads/projects/shirin-garden/living.jpg','Formal living, designed for everyday comfort','gallery',1,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(2,1,'uploads/projects/shirin-garden/bedroom.jpg','Master bedroom with warm, layered lighting','gallery',2,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(3,1,'uploads/projects/shirin-garden/floor-plan.jpg','Location map & ground floor plan','floor_plan',3,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(4,1,'uploads/projects/shirin-garden/floor-plan-types.jpg','1st to 9th floor plan with apartment sizes','floor_plan',4,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(5,1,'uploads/projects/shirin-garden/floor-plan-ab.jpg','Type A & Type B floor plans','floor_plan',5,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(6,1,'uploads/projects/shirin-garden/floor-plan-cd.jpg','Type C & Type D floor plans','floor_plan',6,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(7,2,'uploads/projects/brothers-garden/floor-plan.jpg','Location map & ground floor plan','floor_plan',1,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(8,2,'uploads/projects/brothers-garden/floor-plan-types.jpg','1st to 7th floor plan with apartment sizes','floor_plan',2,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(9,2,'uploads/projects/brothers-garden/floor-plan-ab.jpg','Type A & Type B floor plans','floor_plan',3,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(10,2,'uploads/projects/brothers-garden/floor-plan-c.jpg','Type C floor plan','floor_plan',4,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(11,3,'uploads/projects/naima-palace/floor-plan.jpg','Location map & ground floor plan','floor_plan',1,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(12,3,'uploads/projects/naima-palace/floor-plan-types.jpg','Typical floor plan & apartment sizes','floor_plan',2,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(13,4,'uploads/projects/shiri-serenity/floor-plan.jpg','Location map & ground floor plan','floor_plan',1,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(14,4,'uploads/projects/shiri-serenity/floor-plan-types.jpg','Typical floor plan & apartment sizes','floor_plan',2,'2026-11-12 12:32:47','2026-11-12 12:32:47');
/*!40000 ALTER TABLE `project_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ongoing',
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `nature` varchar(255) NOT NULL DEFAULT 'Residential',
  `floors` varchar(255) DEFAULT NULL,
  `land_area` varchar(255) DEFAULT NULL,
  `facing` varchar(255) DEFAULT NULL,
  `total_apartments` smallint(5) unsigned DEFAULT NULL,
  `total_lifts` tinyint(3) unsigned DEFAULT NULL,
  `apartment_types` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`apartment_types`)),
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `ground_floor` text DEFAULT NULL,
  `handover_year` varchar(255) DEFAULT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `location_image` varchar(255) DEFAULT NULL,
  `brochure_file` varchar(255) DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `projects_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'PRB Shirin Garden','shirin-garden','Ten storeys of calm in the heart of Diabari.','Diabari, Uttara, Dhaka-1230','PRB Shirin Garden is a thoughtfully composed ten-storey residential address in Diabari, Uttara. With only four apartments per floor, every home enjoys privacy, cross ventilation and generous natural light. The layouts balance formal and family living with practical dining and service zones, while the landscaped balconies create a quiet pause above the city. A west-facing frontage, secure parking and a fully considered ground floor make everyday living feel effortless.','ongoing',1,1,'Residential','10 Storied (G+9)','12.50 Katha','West',36,2,'[{\"type\":\"Type A\",\"size\":\"1475 Sft.\"},{\"type\":\"Type B\",\"size\":\"1518 Sft.\"},{\"type\":\"Type C\",\"size\":\"1518 Sft.\"},{\"type\":\"Type D\",\"size\":\"1464 Sft.\"}]','[\"3 Bedrooms\",\"3 Bathrooms\",\"2 Verandahs\",\"Formal Living\",\"Dining\",\"Kitchen\"]','24/7 monitored car parking, reception, guard post, caretaker room, generator room, E.M.R. room, kitchen & toilet.',NULL,'uploads/projects/shirin-garden/hero.jpg','uploads/projects/shirin-garden/hero.jpg',NULL,NULL,1,'2026-11-12 12:32:46','2026-11-12 12:32:46'),(2,'PRB Brothers Garden','brothers-garden','A quietly confident address in Kosaibari.','Kosaibari, Uttara, Dhaka-1230','Set on a 7-katha plot in Kosaibari, Uttara, PRB Brothers Garden brings a sense of calm to a well-connected neighbourhood. The eight-storey building offers twenty-one efficient three-bedroom homes with considered storage and service spaces. A north-west orientation fills the living areas with soft daylight, while the secure ground floor, dedicated parking and professional management keep daily life simple and safe.','ongoing',1,1,'Residential','08 Storied (G+7)','7.00 Katha','North-West',21,1,'[{\"type\":\"Type A\",\"size\":\"1409 Sft.\"},{\"type\":\"Type B\",\"size\":\"1386 Sft.\"},{\"type\":\"Type C\",\"size\":\"1306 Sft.\"}]','[\"3 Bedrooms\",\"3 Bathrooms\",\"2 Verandahs\",\"Formal Living\",\"Dining\",\"Kitchen\"]','24/7 monitored car parking, reception, guard post, caretaker room, generator room, E.M.R. room, kitchen & toilet.',NULL,'uploads/projects/brothers-garden/hero.jpg','uploads/projects/brothers-garden/hero.jpg',NULL,NULL,2,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(3,'PRB Naima Palace','naima-palace','Expansive family living on Gawair Madrasha Road.','Gawair Madrasha Road, Dakshinkhan, Uttara, Dhaka-1230','PRB Naima Palace offers just two generously sized apartments per floor, creating a rare sense of privacy in Dakshinkhan. Homes extend from 1,573 to 1,638 square feet with three bedrooms, three bathrooms and three verandahs, along with formal living, dining and a well-planned kitchen. A north-east orientation, community room and secure parking support a comfortable, connected family life.','upcoming',1,1,'Residential','08 Storied (G+7)','5.00 Katha','North-East',14,1,'[{\"type\":\"Type A\",\"size\":\"1573 Sft.\"},{\"type\":\"Type B\",\"size\":\"1638 Sft.\"}]','[\"3 Bedrooms\",\"3 Bathrooms\",\"3 Verandahs\",\"Formal Living\",\"Dining\",\"Kitchen\"]','24/7 monitored car parking, guard post, community room, caretaker room, generator room, kitchen & toilet.',NULL,'uploads/projects/naima-palace/hero.jpg','uploads/projects/naima-palace/hero.jpg',NULL,NULL,3,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(4,'PRB Shiri Serenity','shiri-serenity','South-facing light in the heart of Kamarpara.','Kamarpara, Uttara, Dhaka-1230','PRB Shiri Serenity is a south-facing residential retreat in Kamarpara, Uttara. With only two apartments per floor, each home is open, bright and designed for family life. Separate formal and family living areas sit alongside three bedrooms, three bathrooms and two verandahs. Community spaces, safe parking and a carefully managed ground floor complete a home that feels as calm as its name.','upcoming',1,1,'Residential','08 Storied (G+7)','5.00 Katha','South',14,1,'[{\"type\":\"Type A\",\"size\":\"1400 Sft.\"},{\"type\":\"Type B\",\"size\":\"1320 Sft.\"}]','[\"3 Bedrooms\",\"3 Bathrooms\",\"2 Verandahs\",\"Formal Living\",\"Family Living\",\"Dining\",\"Kitchen\"]','24/7 monitored car parking, guard post, community room, caretaker room, generator room, kitchen & toilet.',NULL,'uploads/projects/shiri-serenity/hero.jpg','uploads/projects/shiri-serenity/hero.jpg',NULL,NULL,4,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(5,'PRB Habib Manor','habib-manor','A completed residential address in Uttara.','Uttara, Dhaka','A completed PRB residential development in Uttara, delivered with the same attention to structure, comfort and everyday functionality that defines every PRB address.','completed',0,1,'Residential',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'uploads/projects/habib-manor/hero.jpg','uploads/projects/habib-manor/hero.jpg',NULL,NULL,5,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(6,'PRB Khudeza Del','khudeza-del','A completed residential address in Uttara.','Uttara, Dhaka','A completed PRB residential development in Uttara, delivered with the same attention to structure, comfort and everyday functionality that defines every PRB address.','completed',0,1,'Residential',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'uploads/projects/khudeza-del/hero.jpg','uploads/projects/khudeza-del/hero.jpg',NULL,NULL,6,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(7,'PRB Akter Maleka 01','akter-maleka-01','A completed residential address in Uttara.','Uttara, Dhaka','A completed PRB residential development in Uttara, delivered with the same attention to structure, comfort and everyday functionality that defines every PRB address.','completed',0,1,'Residential',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'uploads/projects/akter-maleka-01/hero.jpg','uploads/projects/akter-maleka-01/hero.jpg',NULL,NULL,7,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(8,'PRB Akter Maleka 02','akter-maleka-02','A completed residential address in Uttara.','Uttara, Dhaka','A completed PRB residential development in Uttara, delivered with the same attention to structure, comfort and everyday functionality that defines every PRB address.','completed',0,1,'Residential',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'uploads/projects/akter-maleka-02/hero.jpg','uploads/projects/akter-maleka-02/hero.jpg',NULL,NULL,8,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(9,'PRB Aroshi Villa','aroshi-villa','A completed residential address in Uttara.','Uttara, Dhaka','A completed PRB residential development in Uttara, delivered with the same attention to structure, comfort and everyday functionality that defines every PRB address.','completed',0,1,'Residential',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'uploads/projects/aroshi-villa/hero.jpg','uploads/projects/aroshi-villa/hero.jpg',NULL,NULL,9,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(10,'PRB Johura Ahmed','johura-ahmed','A completed residential address in Uttara.','Uttara, Dhaka','A completed PRB residential development in Uttara, delivered with the same attention to structure, comfort and everyday functionality that defines every PRB address.','completed',0,1,'Residential',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'uploads/projects/johura-ahmed/hero.jpg','uploads/projects/johura-ahmed/hero.jpg',NULL,NULL,10,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(11,'PRB Ruhina Palace','ruhina-palace','A completed residential address in Uttara.','Uttara, Dhaka','A completed PRB residential development in Uttara, delivered with the same attention to structure, comfort and everyday functionality that defines every PRB address.','completed',0,1,'Residential',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'uploads/projects/ruhina-palace/hero.jpg','uploads/projects/ruhina-palace/hero.jpg',NULL,NULL,11,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(12,'PRB Nilachal Bhaban','nilachal-bhaban','A completed residential address in Uttara.','Uttara, Dhaka','A completed PRB residential development in Uttara, delivered with the same attention to structure, comfort and everyday functionality that defines every PRB address.','completed',0,1,'Residential',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'uploads/projects/nilachal-bhaban/hero.jpg','uploads/projects/nilachal-bhaban/hero.jpg',NULL,NULL,12,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(13,'PRB Hossain Garden','hossain-garden','A completed residential address in Uttara.','Uttara, Dhaka','A completed PRB residential development in Uttara, delivered with the same attention to structure, comfort and everyday functionality that defines every PRB address.','completed',0,1,'Residential',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'uploads/projects/hossain-garden/hero.jpg','uploads/projects/hossain-garden/hero.jpg',NULL,NULL,13,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(14,'AsianCity, Kawlar','asiancity-kawlar','A completed residential address in Kawlar.','Kawlar, Uttara, Dhaka','A completed PRB residential development in Kawlar, Uttara, delivered with the same attention to structure, comfort and everyday functionality that defines every PRB address.','completed',0,1,'Residential',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'uploads/projects/asiancity-kawlar/hero.jpg','uploads/projects/asiancity-kawlar/hero.jpg',NULL,NULL,14,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(15,'Mollartek, Uttara','mollartek-uttara','A completed residential address in Mollartek.','Mollartek, Uttara, Dhaka','A completed PRB residential development in Mollartek, Uttara, delivered with the same attention to structure, comfort and everyday functionality that defines every PRB address.','completed',0,1,'Residential',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'uploads/projects/mollartek-uttara/hero.jpg','uploads/projects/mollartek-uttara/hero.jpg',NULL,NULL,15,'2026-11-12 12:32:47','2026-11-12 12:32:47');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('2uLIkpdiDzoKWeZru0OJTzaN4RT4UimQKetEEkIm',NULL,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJ4a3FLTkxxTzRoZTlVaVRrS2g3VzJISW9vMjBRdmNZMHRSNVJ3c2pVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5XC9hZG1pblwvbG9naW4iLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1794487100),('5FNMk2iUh8A0mumV0vjAH07OVNJVX3dMU3glLH2h',NULL,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJTeVdTb1ZYWjNKS2xGSUliRllDTnNxbWZtWmk2MGQ4RWNBM0NqaGxQIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5XC9hZG1pblwvbG9naW4iLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwicGFzc3dvcmRfaGFzaF9hZG1pbiI6ImRiYjhjZjg5N2MzMWRjZWY3YzIzODZiYjczY2EzZDY3ZjM5NDAyODQ4N2IxZTFmYmQ4MjYxMzU3ODZmOGFjNTMifQ==',1794489008),('8Y3erUh8gJVXYpPINurC7s5KGqZZc12mJXzjDazu',1,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJmcVBIcFB1ZERFQnVhWm0xclF5NzVwbklUQ2puVVpYY3NCMnFHN0I2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5XC9hZG1pblwvYW1lbml0aWVzXC8xXC9lZGl0Iiwicm91dGUiOiJhZG1pbi5hbWVuaXRpZXMuZWRpdCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfYWRtaW4iOiJkYmI4Y2Y4OTdjMzFkY2VmN2MyMzg2YmI3M2NhM2Q2N2YzOTQwMjg0ODdiMWUxZmJkODI2MTM1Nzg2ZjhhYzUzIn0=',1794488856),('BtT9VD4py28ltNvJfzCOE9ADAqic6DJycMIJ4Alz',NULL,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJwalY1WWRWa0djQzFKS3drdnRKQkxobmhmMDUzdzdxT1B0Z0sxdE9BIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5XC9nYWxsZXJ5Iiwicm91dGUiOiJnYWxsZXJ5In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1794486898),('Co9UsoDoF1MvDnhdWBrFUk74bt9krUr85pt5cxWe',NULL,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJ0ZWMzRnVZQWdBb2xRWlg5NzFhdXNlbkhJRVhpWENQekVwZ3F1cjRuIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1794486991),('FetgI0iyOHNLW2idcnzb63jJhZ4IrDFURM9TOVXb',1,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJCYjk2Z3BuUlEyN2RZcjFGRTZHUXBkMTBGdnpoNGl2V2piNVkyN0RrIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5XC9hZG1pblwvc2V0dGluZ3MiLCJyb3V0ZSI6ImFkbWluLnNldHRpbmdzLmVkaXQifSwiX2ZsYXNoIjp7Im9sZCI6WyJzdWNjZXNzIl0sIm5ldyI6W119LCJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJwYXNzd29yZF9oYXNoX2FkbWluIjoiZGJiOGNmODk3YzMxZGNlZjdjMjM4NmJiNzNjYTNkNjdmMzk0MDI4NDg3YjFlMWZiZDgyNjEzNTc4NmY4YWM1MyIsInN1Y2Nlc3MiOiJQcm9qZWN0IGRlbGV0ZWQgc3VjY2Vzc2Z1bGx5LiJ9',1794489053),('FPgiTie8eVAapCfWS5jGf7Xeh5PX1kyYuu1ZroZm',NULL,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJ2dk5sMmhoWnRPeXJCV2lBMWdxN25rTVp6aUU2ZU95eTN6VkoxVm8xIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5XC9jb250YWN0Iiwicm91dGUiOiJjb250YWN0In0sIl9mbGFzaCI6eyJvbGQiOlsic3VjY2VzcyJdLCJuZXciOltdfSwic3VjY2VzcyI6IlRoYW5rIHlvdSBmb3IgcmVhY2hpbmcgb3V0LiBPdXIgdGVhbSB3aWxsIGNvbnRhY3QgeW91IHNob3J0bHkuIn0=',1794488971),('Fu9Ks5L2YKGX58Db6u9zux0JV5LShxu0vUcjbW7G',NULL,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJqMG1vS1BWUUtRMDFqUmt4YW90Qm8wUkN5cUNCdFd1YldoZW5YRWtlIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5XC9hYm91dCIsInJvdXRlIjoiYWJvdXQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1794487087),('FwM7qhwgXUfPjkG06I0lZXAd7yT6kdGQQpBFgOkf',NULL,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiIxaFk3SUFZWEpXR2t0VjFzS3VDZDNyNVBrc3BDeU53bGgzTlYxTWtIIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5XC9wcm9qZWN0cyIsInJvdXRlIjoicHJvamVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1794487089),('glaPGy6Way9y9Y516Z3hqRxhBdUavrIX9jShynEf',NULL,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJEOGFyN2sxVVFiQkRTRnQzbUF5MHNOTVVqcXFVbUo2QjNxbjNhRUdPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5XC9wcm9qZWN0cyIsInJvdXRlIjoicHJvamVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1794486887),('GZGuh7KclrK4AVBYa3JhcG37Fb2dZc3qfAWzugb4',NULL,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJuYVpvN0NhN1pXMVZ2RFRPSTNPQjAzQTdSZVFyVXI1cXZtS2hzdk82IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5XC9wcm9qZWN0c1wvc2hpcmluLWdhcmRlbiIsInJvdXRlIjoicHJvamVjdHMuc2hvdyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1794486894),('iW7QPiShO4RaFGd8dqkJ59VkcwXbNA9lrxZkVVLi',1,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJJYkxmVDEwTUJRWUI5YktyaFo5RmFMU1Z3Mno1M2dSOTVkaENxOUVaIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5XC9hZG1pblwvc2V0dGluZ3MiLCJyb3V0ZSI6ImFkbWluLnNldHRpbmdzLmVkaXQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJwYXNzd29yZF9oYXNoX2FkbWluIjoiZGJiOGNmODk3YzMxZGNlZjdjMjM4NmJiNzNjYTNkNjdmMzk0MDI4NDg3YjFlMWZiZDgyNjEzNTc4NmY4YWM1MyJ9',1794488699),('N76TQoah2x7mPddRet7yBapRrMdpGNJ1T4UWfvyc',NULL,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJEM0ZwN0lXVW5nVEplNkxNaHBjVnlyNDdPRjBPYTVIaGJOOU5FazVUIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5XC9hYm91dCIsInJvdXRlIjoiYWJvdXQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1794486883),('q2eHmgZOTGZO7VGuTabzDHYRuVbdCSLP9zFz2ULB',NULL,'127.0.0.1','Symfony','eyJfdG9rZW4iOiI1YjJwcHE5SHBIZEJHM1QzTXJtazZJZFdKT2FHWHdIM3dHR3RjUTU2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1794487069),('thQZuplDjIRdMSPf6Ifk4PeF75rwVYtZ6PRHHfwx',NULL,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJCNkI5SFlnYk1icklIT2RrWEJYdnRPVkVLZElaQ21xUHNDZ1N3azVxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5XC9nYWxsZXJ5Iiwicm91dGUiOiJnYWxsZXJ5In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1794487096),('v70sHlETe1mmXDVa6Ql3ydncbee6uLF7SfiUulNn',NULL,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJMWjBKcVlEekhKRTd2Y2g3bFJYODVGcVNMQm5iU2VqUWZsZWNOVWlxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5XC9jb250YWN0Iiwicm91dGUiOiJjb250YWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1794487098),('W8RfoDobXnLRb4IfGzxA5kw4WT2aFZb8YYbcogLz',NULL,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJDS29ERjloZjFzZmg3NjBrTWlUZ3BWeWdXWWNTMUJxdUFZS2NxYXo5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1794487084),('WthefOo6jum2wH3IDDo0uRR3NXFBxSwaH5c1cIay',NULL,'127.0.0.1','curl/8.21.0','eyJfdG9rZW4iOiJLYmhIT1l6ekVTM0lCMW5rMjVrb05UVlRLTExBRGd3blllV1RtOURxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDk5XC9wcm9qZWN0c1wvc2hpcmluLWdhcmRlbiIsInJvdXRlIjoicHJvamVjdHMuc2hvdyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1794487094);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site_name','PRB Holdings','general','2026-11-12 12:32:46','2026-11-12 12:32:46'),(2,'site_tagline','Your Satisfaction Is Our Dream...','general','2026-11-12 12:32:46','2026-11-12 12:32:46'),(3,'phone','01550 - 028550','general','2026-11-12 12:32:46','2026-11-12 12:32:46'),(4,'phone_link','+8801550028550','general','2026-11-12 12:32:46','2026-11-12 12:32:46'),(5,'email','info@prbholdingsbd.com','general','2026-11-12 12:32:46','2026-11-12 12:32:46'),(6,'address','House - 07, Road - 17, Sector - 04, Uttara, Dhaka-1230.','general','2026-11-12 12:32:46','2026-11-12 12:32:46'),(7,'office_hours','Saturday – Thursday, 9:00 AM – 7:00 PM','general','2026-11-12 12:32:46','2026-11-12 12:32:46'),(8,'map_embed','https://www.google.com/maps?q=House+07+Road+17+Sector+04+Uttara+Dhaka&output=embed','general','2026-11-12 12:32:46','2026-11-12 12:32:46'),(9,'facebook','https://www.facebook.com/','general','2026-11-12 12:32:46','2026-11-12 12:32:46'),(10,'instagram','https://www.instagram.com/','general','2026-11-12 12:32:46','2026-11-12 12:32:46'),(11,'linkedin','https://www.linkedin.com/','general','2026-11-12 12:32:46','2026-11-12 12:32:46'),(12,'youtube','https://www.youtube.com/','general','2026-11-12 12:32:46','2026-11-12 12:32:46'),(13,'whatsapp','+8801550028550','general','2026-11-12 12:32:46','2026-11-12 12:32:46'),(14,'about_eyebrow','About PRB Holdings','about','2026-11-12 12:32:46','2026-11-12 12:32:46'),(15,'about_heading','Redefining your standard of living','about','2026-11-12 12:32:46','2026-11-12 12:32:46'),(16,'about_short','PRB Holdings is one of the fastest growing Construction / Real Estate companies in Bangladesh. Under the guidance of our top management, our team of expert engineers and architects are committed to revolutionise the modern real estate industry of Bangladesh through achieving total satisfaction of our coveted customers.','about','2026-11-12 12:32:46','2026-11-12 12:32:46'),(17,'about_story','PRB Holdings is one of the fastest growing Construction / Real Estate companies in Bangladesh. Under the guidance of our top management, our team of expert engineers and architects are committed to revolutionise the modern real estate industry of Bangladesh through achieving total satisfaction of our coveted customers.\n\nWe have successfully completed a substantial number of projects. Since the very beginning, our aim was to build a relationship based on mutual trust and respect with our clients. Within this short period, the response that we have received from our well-wishers has motivated us to go an extra mile to attain perfection. Through ensuring unwavering quality, we always try our level best to repay the faith that our buyers have put in us.\n\nPRB Holdings started residential building construction in this heavily competitive market and with the goodwill of everyone related, we have been able to establish a good reputation in the industry. Now, we are eyeing to expand our horizons so that we can serve our clients in every possible way.\n\nWe want to establish ourselves not only as mere service providers, but also as total caregivers for our trusted stakeholders. With our heartiest endeavour, we want to march forward with a mission to become one of the leading construction companies in the world.','about','2026-11-12 12:32:46','2026-11-12 12:32:46'),(18,'vision','To be the most preferred innovative developer of the country.','about','2026-11-12 12:32:46','2026-11-12 12:32:46'),(19,'mission','To satisfy our landowners and buyers through our heartiest endeavour and nation building through sustainable, planned housing facilities.','about','2026-11-12 12:32:46','2026-11-12 12:32:46'),(20,'about_image_main','uploads/projects/shirin-garden/living.jpg','about','2026-11-12 12:32:46','2026-11-12 12:32:46'),(21,'about_image_secondary','uploads/projects/shirin-garden/bedroom.jpg','about','2026-11-12 12:32:46','2026-11-12 12:32:46'),(22,'hero_badge','Building trust since day one','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(23,'projects_eyebrow','Our Portfolio','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(24,'projects_heading','Bespoke enclaves with finesse in architecture and design','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(25,'projects_text','Explore a collection of contemporary residential addresses across Uttara — each planned around light, privacy and everyday comfort.','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(26,'amenities_eyebrow','Signature Amenities','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(27,'amenities_heading','Everyday luxuries, thoughtfully curated','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(28,'amenities_text','From round-the-clock security to generous parking and community spaces, every PRB address is designed to make daily life feel effortless.','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(29,'testimonials_eyebrow','Our Residents','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(30,'testimonials_heading','Stories from the families who call PRB home','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(31,'cta_eyebrow','Let\'s Build Together','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(32,'cta_heading','Have land? Let\'s turn it into a landmark.','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(33,'cta_text','Partner with a developer who values your investment as much as you do. We handle planning, approvals, construction and handover — with complete transparency at every stage.','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(34,'landowner_title','For Landowners','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(35,'landowner_text','Build your sanctuary with a team that protects your land, your timeline and your peace of mind.','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(36,'buyer_title','For Buyers','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(37,'buyer_text','Invest in a better tomorrow with thoughtfully designed apartments in Uttara\'s most connected neighbourhoods.','home','2026-11-12 12:32:46','2026-11-12 12:32:46'),(38,'footer_about','A modern real estate developer creating sustainable, thoughtfully planned residential communities across Uttara, Dhaka.','footer','2026-11-12 12:32:46','2026-11-12 12:32:46'),(39,'copyright','© 2026 PRB Holdings. All rights reserved.','footer','2026-11-12 12:32:46','2026-11-12 12:32:46'),(40,'meta_title','PRB Holdings | Modern Residential Apartments in Uttara, Dhaka','seo','2026-11-12 12:32:46','2026-11-12 12:32:46'),(41,'meta_description','PRB Holdings is a fast-growing construction and real estate company in Bangladesh, building thoughtfully designed residential apartments in Uttara, Dhaka. Your satisfaction is our dream.','seo','2026-11-12 12:32:46','2026-11-12 12:32:46'),(42,'og_image','uploads/hero/shirin-garden.jpg','seo','2026-11-12 12:32:46','2026-11-12 12:32:46');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rating` tinyint(3) unsigned NOT NULL DEFAULT 5,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `testimonials_project_id_foreign` (`project_id`),
  CONSTRAINT `testimonials_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Md. Rafiqul Islam','Apartment Owner','From the first site visit to handover, the PRB team was transparent and responsive. The apartment is bright, well planned and genuinely feels like home.',NULL,5,1,1,1,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(2,'Farzana Akter','Apartment Owner','What impressed us most was the attention to detail — the ventilation, the storage and the quality of finishes. We felt looked after at every stage.',NULL,5,2,1,2,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(3,'A. S. M. Faizullah','Landowner Partner','PRB respected our land, our timeline and our opinions. The communication was clear from day one, and the result speaks for itself.',NULL,5,3,1,3,'2026-11-12 12:32:47','2026-11-12 12:32:47'),(4,'Nusrat Jahan','Apartment Owner','A secure, peaceful building in a great location. The team still checks in after handover, which says a lot about how much they care.',NULL,5,1,1,4,'2026-11-12 12:32:47','2026-11-12 12:32:47');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2026-11-12 19:16:22
