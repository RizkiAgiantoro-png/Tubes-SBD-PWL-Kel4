/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.6-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: lumiere
-- ------------------------------------------------------
-- Server version	11.8.6-MariaDB

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `booking_details`
--

DROP TABLE IF EXISTS `booking_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking_details` (
  `booking_detail_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `service_id` bigint(20) unsigned NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`booking_detail_id`),
  KEY `booking_details_booking_id_foreign` (`booking_id`),
  KEY `booking_details_service_id_foreign` (`service_id`),
  CONSTRAINT `booking_details_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE,
  CONSTRAINT `booking_details_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_details`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `booking_details` DISABLE KEYS */;
INSERT INTO `booking_details` VALUES
(1,1,1,1,81000.00,'2026-06-09 08:36:07','2026-06-09 08:36:07');
/*!40000 ALTER TABLE `booking_details` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `booking_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `salon_id` bigint(20) unsigned NOT NULL,
  `staff_id` bigint(20) unsigned DEFAULT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `total_harga` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status_booking` enum('pending','paid','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `bookings_customer_id_foreign` (`customer_id`),
  KEY `bookings_salon_id_foreign` (`salon_id`),
  KEY `bookings_staff_id_foreign` (`staff_id`),
  CONSTRAINT `bookings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookings_salon_id_foreign` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`salon_id`) ON DELETE CASCADE,
  CONSTRAINT `bookings_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES
(1,1,1,NULL,'2026-06-09','11:35:00',81000.00,'pending','2026-06-09 08:36:07','2026-06-09 08:36:07');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `category_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `categories_nama_category_unique` (`nama_category`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(1,'Hair Care','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(2,'Hair Coloring','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(3,'Nail Care','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(4,'Facial & Skin Care','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(5,'Body Treatment','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(6,'Makeup','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(7,'Eyebrow & Eyelash','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(8,'Waxing & Threading','2026-06-09 08:34:46','2026-06-09 08:34:46');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
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

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `kotas`
--

DROP TABLE IF EXISTS `kotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `kotas` (
  `kota_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kota` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kota_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kotas`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `kotas` DISABLE KEYS */;
INSERT INTO `kotas` VALUES
(1,'Jakarta','DKI Jakarta','2026-06-09 08:32:15','2026-06-09 08:32:15'),
(2,'Bandung','Jawa Barat','2026-06-09 08:32:15','2026-06-09 08:32:15'),
(3,'Surabaya','Jawa Timur','2026-06-09 08:32:15','2026-06-09 08:32:15'),
(4,'Yogyakarta','DI Yogyakarta','2026-06-09 08:32:15','2026-06-09 08:32:15'),
(5,'Bali','Bali','2026-06-09 08:32:15','2026-06-09 08:32:15');
/*!40000 ALTER TABLE `kotas` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_05_14_054509_create_kotas_table',1),
(5,'2026_05_14_054533_create_salons_table',1),
(6,'2026_05_14_054632_create_salon_images_table',1),
(7,'2026_05_14_054643_create_categories_table',1),
(8,'2026_05_14_054655_create_services_table',1),
(9,'2026_05_14_054705_create_staff_table',1),
(10,'2026_05_14_054719_create_schedules_table',1),
(11,'2026_05_14_054730_create_bookings_table',1),
(12,'2026_05_14_054742_create_booking_details_table',1),
(13,'2026_05_14_054754_create_payments_table',1),
(14,'2026_05_14_054810_create_reviews_table',1),
(15,'2026_05_14_071940_add_role_to_users_table',1),
(16,'2026_05_17_105421_add_coordinates_to_salons_table',1),
(17,'2026_05_27_025457_add_midtrans_fields_to_payments_table',1),
(18,'2026_05_27_033936_change_metode_pembayaran_to_string_on_payments_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `payment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `midtrans_order_id` varchar(255) DEFAULT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `snap_redirect_url` varchar(255) DEFAULT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `total_bayar` decimal(12,2) NOT NULL,
  `payment_status` enum('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `transaction_status` varchar(255) DEFAULT NULL,
  `fraud_status` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  UNIQUE KEY `payments_booking_id_unique` (`booking_id`),
  UNIQUE KEY `payments_midtrans_order_id_unique` (`midtrans_order_id`),
  CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES
(1,1,'LUMIERE-1-1781019794','42beeb4a-687d-4640-ad22-a1f29f2312d6','https://app.sandbox.midtrans.com/snap/v4/redirection/42beeb4a-687d-4640-ad22-a1f29f2312d6','midtrans',NULL,81000.00,'pending',NULL,NULL,NULL,'2026-06-09 08:36:07','2026-06-09 08:43:16');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `review_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `salon_id` bigint(20) unsigned NOT NULL,
  `rating` int(11) NOT NULL,
  `komentar` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  UNIQUE KEY `reviews_booking_id_unique` (`booking_id`),
  KEY `reviews_customer_id_foreign` (`customer_id`),
  KEY `reviews_salon_id_foreign` (`salon_id`),
  CONSTRAINT `reviews_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_salon_id_foreign` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`salon_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `salon_images`
--

DROP TABLE IF EXISTS `salon_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `salon_images` (
  `image_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `salon_id` bigint(20) unsigned NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `image_type` enum('gallery','banner','logo','interior','treatment') NOT NULL DEFAULT 'gallery',
  `is_thumbnail` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `salon_images_salon_id_foreign` (`salon_id`),
  CONSTRAINT `salon_images_salon_id_foreign` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`salon_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salon_images`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `salon_images` DISABLE KEYS */;
INSERT INTO `salon_images` VALUES
(1,1,'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=800','banner',1,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(2,1,'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800','interior',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(3,1,'https://images.unsplash.com/photo-1487412947147-5cebf100ffc2?w=800','gallery',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(4,1,'https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=800','gallery',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(5,2,'https://images.unsplash.com/photo-1633681926022-84c23e8cb2d6?w=800','banner',1,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(6,2,'https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?w=800','interior',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(7,2,'https://images.unsplash.com/photo-1600948836101-f9ffda59d250?w=800','gallery',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(8,3,'https://images.unsplash.com/photo-1507652313519-d4e9174996dd?w=800','banner',1,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(9,3,'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=800','treatment',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(10,3,'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=800','interior',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(11,3,'https://images.unsplash.com/photo-1519823551278-64ac92734fb1?w=800','gallery',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(12,4,'https://images.unsplash.com/photo-1516975080664-ed2fc6a32937?w=800','banner',1,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(13,4,'https://images.unsplash.com/photo-1612817288484-6f916006741a?w=800','interior',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(14,4,'https://images.unsplash.com/photo-1582095133179-bfd08e2fb6b8?w=800','gallery',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(15,5,'https://images.unsplash.com/photo-1562322140-8baeececf3df?w=800','banner',1,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(16,5,'https://images.unsplash.com/photo-1605497788044-5a32c7078486?w=800','interior',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(17,5,'https://images.unsplash.com/photo-1610992015732-2449b76344bc?w=800','gallery',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(18,6,'https://images.unsplash.com/photo-1527799820374-87036083e756?w=800','banner',1,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(19,6,'https://images.unsplash.com/photo-1624374552756-f7b75c2f7e52?w=800','interior',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(20,6,'https://images.unsplash.com/photo-1610992015749-698d4b7dd3ec?w=800','treatment',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(21,6,'https://images.unsplash.com/photo-1601517491119-1ddc40eb0d57?w=800','gallery',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(22,7,'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800','banner',1,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(23,7,'https://images.unsplash.com/photo-1583416750470-965b2707b355?w=800','interior',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(24,7,'https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=800','treatment',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(25,7,'https://images.unsplash.com/photo-1552693673-1bf958298935?w=800','gallery',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(26,8,'https://images.unsplash.com/photo-1600334089648-b0d9d3028eb2?w=800','banner',1,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(27,8,'https://images.unsplash.com/photo-1559599101-f09722fb4948?w=800','interior',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(28,8,'https://images.unsplash.com/photo-1630508963837-c86b3d6e7cc3?w=800','treatment',0,'2026-06-09 08:32:17','2026-06-09 08:32:17'),
(29,8,'https://images.unsplash.com/photo-1596755389378-c31d21fd1273?w=800','gallery',0,'2026-06-09 08:32:17','2026-06-09 08:32:17');
/*!40000 ALTER TABLE `salon_images` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `salons`
--

DROP TABLE IF EXISTS `salons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `salons` (
  `salon_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` bigint(20) unsigned NOT NULL,
  `kota_id` bigint(20) unsigned NOT NULL,
  `nama_salon` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `rating` decimal(2,1) NOT NULL DEFAULT 0.0,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`salon_id`),
  KEY `salons_owner_id_foreign` (`owner_id`),
  KEY `salons_kota_id_foreign` (`kota_id`),
  CONSTRAINT `salons_kota_id_foreign` FOREIGN KEY (`kota_id`) REFERENCES `kotas` (`kota_id`),
  CONSTRAINT `salons_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salons`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `salons` DISABLE KEYS */;
INSERT INTO `salons` VALUES
(1,2,1,'Lumiere Beauty Studio','Jl. Sudirman No. 45, Tanah Abang, Jakarta Pusat',-6.2088000,106.8456000,'Salon premium di jantung Jakarta dengan layanan perawatan rambut dan kecantikan modern. Dipercaya lebih dari 5.000 pelanggan sejak 2018.',4.8,'09:00:00','21:00:00','active','2026-06-09 08:32:17','2026-06-09 08:32:17'),
(2,3,1,'Glam House Salon','Jl. Kemang Raya No. 12, Kemang, Jakarta Selatan',-6.2607000,106.8137000,'Surga kecantikan di kawasan Kemang. Spesialis hair coloring, nail art, dan perawatan kulit dengan produk internasional.',4.6,'10:00:00','20:00:00','active','2026-06-09 08:32:17','2026-06-09 08:32:17'),
(3,4,2,'Serene Spa & Salon','Jl. Dago No. 88, Coblong, Bandung',-6.8872000,107.6103000,'Temukan ketenangan di Serene Spa & Salon. Menawarkan paket lengkap dari hair treatment, facial, hingga full body spa di Dago yang asri.',4.9,'08:00:00','20:00:00','active','2026-06-09 08:32:17','2026-06-09 08:32:17'),
(4,5,2,'Aura Beauty Lounge','Jl. Riau No. 55, Cibeunying, Bandung',-6.9147000,107.6098000,'Salon modern berkonsep lounge untuk pengalaman kecantikan yang nyaman dan mewah. Spesialis bridal make-up dan hair styling.',4.5,'09:00:00','19:00:00','active','2026-06-09 08:32:17','2026-06-09 08:32:17'),
(5,6,3,'Radiance Salon Surabaya','Jl. Darmo Permai No. 7, Sukomanunggal, Surabaya',-7.2756000,112.7270000,'Salon terpercaya di Surabaya Barat dengan tim stylist berpengalaman. Pelayanan ramah dan hasil terbaik untuk setiap pelanggan.',4.7,'09:00:00','21:00:00','active','2026-06-09 08:32:17','2026-06-09 08:32:17'),
(6,7,4,'Jogja Cantik Salon','Jl. Malioboro No. 120, Gedongtengen, Yogyakarta',-7.7928000,110.3660000,'Salon dengan sentuhan budaya Jawa yang kental di jantung Kota Gudeg. Tersedia perawatan tradisional dan modern dalam suasana yang hangat.',4.6,'09:00:00','20:00:00','active','2026-06-09 08:32:17','2026-06-09 08:32:17'),
(7,8,5,'Bali Glow Spa & Salon','Jl. Oberoi No. 8, Seminyak, Badung, Bali',-8.6905000,115.1609000,'Pengalaman spa dan salon terbaik di Seminyak. Nikmati ritual kecantikan khas Bali dengan bahan-bahan alami pilihan dan nuansa tropis yang memanjakan.',5.0,'08:00:00','22:00:00','active','2026-06-09 08:32:17','2026-06-09 08:32:17'),
(8,9,5,'Tropicana Beauty Bar','Jl. Monkey Forest No. 21, Ubud, Gianyar, Bali',-8.5069000,115.2625000,'Beauty bar unik di tengah keindahan alam Ubud. Spesialisasi dalam organic facial, lulur tradisional, dan hair treatment dengan bahan herbal lokal.',4.8,'09:00:00','21:00:00','active','2026-06-09 08:32:17','2026-06-09 08:32:17');
/*!40000 ALTER TABLE `salons` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedules` (
  `schedule_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` bigint(20) unsigned NOT NULL,
  `hari` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` enum('available','off') NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `schedules_staff_id_foreign` (`staff_id`),
  CONSTRAINT `schedules_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `service_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `salon_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `nama_service` varchar(255) NOT NULL,
  `durasi` int(11) NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`service_id`),
  KEY `services_salon_id_foreign` (`salon_id`),
  KEY `services_category_id_foreign` (`category_id`),
  CONSTRAINT `services_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  CONSTRAINT `services_salon_id_foreign` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`salon_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES
(1,1,1,'Creambath',60,81000.00,'Perawatan rambut dengan krim nutrisi untuk menjaga kelembapan dan kilau rambut.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(2,1,1,'Hair Mask',45,75000.00,'Masker rambut intensif untuk memperbaiki kerusakan dan menutrisi dari dalam.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(3,1,1,'Keratin Treatment',120,368000.00,'Perawatan keratin untuk meluruskan dan menghaluskan rambut hingga 3 bulan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(4,1,1,'Gunting Rambut',30,62000.00,'Potong rambut sesuai keinginan dengan stylist berpengalaman.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(5,1,1,'Blow Dry & Styling',45,88000.00,'Blow dry dan styling rambut untuk penampilan sempurna sehari-hari.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(6,1,1,'Hair Spa',90,135000.00,'Perawatan spa rambut lengkap dengan pijat kepala, masker, dan kondisioner.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(7,1,2,'Highlight',120,279000.00,'Highlight rambut dengan teknik terkini untuk tampilan segar dan modern.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(8,1,2,'Full Color',90,240000.00,'Mewarnai seluruh rambut dengan pilihan warna terlengkap.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(9,1,2,'Balayage',150,550000.00,'Teknik pewarnaan balayage untuk gradasi warna natural yang elegan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(10,1,2,'Ombre',120,412000.00,'Efek ombre dari gelap ke terang yang trendi dan menawan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(11,1,2,'Bleaching',90,385000.00,'Proses bleaching aman untuk persiapan pewarnaan cerah.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(12,1,4,'Basic Facial',60,115000.00,'Pembersihan wajah dasar untuk menjaga kecerahan dan kebersihan kulit.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(13,1,4,'Deep Cleansing Facial',90,187000.00,'Facial pembersihan mendalam untuk mengangkat komedo dan kotoran pori-pori.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(14,1,4,'Brightening Facial',75,198000.00,'Perawatan wajah untuk mencerahkan kulit kusam dan meratakan warna kulit.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(15,1,4,'Anti-Aging Facial',90,230000.00,'Facial anti-penuaan dengan serum kolagen untuk kulit kencang dan elastis.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(16,1,4,'Acne Treatment',60,140000.00,'Perawatan khusus untuk kulit berjerawat dengan teknologi LED therapy.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(17,1,6,'Makeup Natural',60,204000.00,'Riasan natural sehari-hari yang cantik dan tahan lama.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(18,1,6,'Makeup Party',90,343000.00,'Riasan pesta glamor untuk penampilan memukau di berbagai acara.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(19,1,6,'Bridal Makeup',180,776000.00,'Riasan pengantin lengkap dengan trial dan touch-up untuk hari spesialmu.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(20,1,6,'Makeup Wisuda',90,312000.00,'Riasan wisuda elegan yang tahan dari pagi hingga malam.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(21,2,1,'Creambath',60,79000.00,'Perawatan rambut dengan krim nutrisi untuk menjaga kelembapan dan kilau rambut.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(22,2,1,'Hair Mask',45,82000.00,'Masker rambut intensif untuk memperbaiki kerusakan dan menutrisi dari dalam.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(23,2,1,'Keratin Treatment',120,343000.00,'Perawatan keratin untuk meluruskan dan menghaluskan rambut hingga 3 bulan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(24,2,1,'Gunting Rambut',30,70000.00,'Potong rambut sesuai keinginan dengan stylist berpengalaman.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(25,2,1,'Blow Dry & Styling',45,88000.00,'Blow dry dan styling rambut untuk penampilan sempurna sehari-hari.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(26,2,1,'Hair Spa',90,155000.00,'Perawatan spa rambut lengkap dengan pijat kepala, masker, dan kondisioner.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(27,2,2,'Highlight',120,276000.00,'Highlight rambut dengan teknik terkini untuk tampilan segar dan modern.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(28,2,2,'Full Color',90,243000.00,'Mewarnai seluruh rambut dengan pilihan warna terlengkap.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(29,2,2,'Balayage',150,530000.00,'Teknik pewarnaan balayage untuk gradasi warna natural yang elegan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(30,2,2,'Ombre',120,436000.00,'Efek ombre dari gelap ke terang yang trendi dan menawan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(31,2,2,'Bleaching',90,385000.00,'Proses bleaching aman untuk persiapan pewarnaan cerah.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(32,2,3,'Manicure',45,61000.00,'Perawatan kuku tangan lengkap termasuk pembentukan dan pengecatan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(33,2,3,'Pedicure',60,83000.00,'Perawatan kuku kaki lengkap dengan scrub dan moisturizer.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(34,2,3,'Nail Art',60,130000.00,'Desain nail art kreatif sesuai selera dengan berbagai pilihan motif.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(35,2,3,'Gel Nails',90,175000.00,'Cat kuku gel tahan lama hingga 3 minggu tanpa retak.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(36,2,3,'Nail Extension',120,240000.00,'Perpanjangan kuku dengan akrilik atau gel untuk tampilan mewah.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(37,2,3,'Manicure & Pedicure',100,118000.00,'Paket lengkap perawatan kuku tangan dan kaki dengan harga spesial.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(38,2,7,'Sulam Alis',120,455000.00,'Sulam alis semi-permanen dengan teknik microblading untuk alis natural sempurna.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(39,2,7,'Eyebrow Threading',15,35000.00,'Pembentukan alis dengan benang untuk hasil rapi dan presisi.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(40,2,7,'Eyelash Extension',90,277000.00,'Sambung bulu mata dengan berbagai pilihan efek: natural, wispy, atau volume.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(41,2,7,'Lash Lift & Tint',60,182000.00,'Angkat dan warnai bulu mata alami untuk tampilan lentik tanpa maskara.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(42,3,5,'Lulur Tradisional',90,162000.00,'Lulur khas Jawa dengan rempah-rempah pilihan untuk kulit halus bercahaya.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(43,3,5,'Body Scrub',60,164000.00,'Eksfoliasi tubuh menyeluruh untuk mengangkat sel kulit mati.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(44,3,5,'Body Massage',60,173000.00,'Pijat relaksasi tubuh untuk menghilangkan pegal dan stres.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(45,3,5,'Aromatherapy Massage',90,240000.00,'Pijat aromaterapi dengan essential oil pilihan untuk relaksasi total.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(46,3,5,'Body Wrap',90,188000.00,'Perawatan body wrap dengan bahan alami untuk melembapkan dan mengencangkan kulit.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(47,3,5,'Full Body Spa',180,450000.00,'Paket spa lengkap: lulur, masker, pijat, dan mandi susu untuk kesempurnaan perawatan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(48,3,4,'Basic Facial',60,116000.00,'Pembersihan wajah dasar untuk menjaga kecerahan dan kebersihan kulit.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(49,3,4,'Deep Cleansing Facial',90,169000.00,'Facial pembersihan mendalam untuk mengangkat komedo dan kotoran pori-pori.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(50,3,4,'Brightening Facial',75,214000.00,'Perawatan wajah untuk mencerahkan kulit kusam dan meratakan warna kulit.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(51,3,4,'Anti-Aging Facial',90,235000.00,'Facial anti-penuaan dengan serum kolagen untuk kulit kencang dan elastis.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(52,3,4,'Acne Treatment',60,150000.00,'Perawatan khusus untuk kulit berjerawat dengan teknologi LED therapy.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(53,3,1,'Creambath',60,81000.00,'Perawatan rambut dengan krim nutrisi untuk menjaga kelembapan dan kilau rambut.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(54,3,1,'Hair Mask',45,71000.00,'Masker rambut intensif untuk memperbaiki kerusakan dan menutrisi dari dalam.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(55,3,1,'Keratin Treatment',120,350000.00,'Perawatan keratin untuk meluruskan dan menghaluskan rambut hingga 3 bulan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(56,3,1,'Gunting Rambut',30,68000.00,'Potong rambut sesuai keinginan dengan stylist berpengalaman.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(57,3,1,'Blow Dry & Styling',45,78000.00,'Blow dry dan styling rambut untuk penampilan sempurna sehari-hari.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(58,3,1,'Hair Spa',90,164000.00,'Perawatan spa rambut lengkap dengan pijat kepala, masker, dan kondisioner.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(59,3,8,'Full Leg Waxing',45,115000.00,'Waxing kaki menyeluruh untuk kulit mulus dan halus tahan 3–4 minggu.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(60,3,8,'Underarm Waxing',20,61000.00,'Waxing ketiak untuk membersihkan bulu dengan cepat dan minim nyeri.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(61,3,8,'Full Body Waxing',120,375000.00,'Waxing seluruh tubuh untuk kulit bersih dan halus sempurna.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(62,3,8,'Facial Threading',30,54000.00,'Threading wajah untuk membersihkan bulu halus dan membentuk alis.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(63,4,6,'Makeup Natural',60,216000.00,'Riasan natural sehari-hari yang cantik dan tahan lama.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(64,4,6,'Makeup Party',90,354000.00,'Riasan pesta glamor untuk penampilan memukau di berbagai acara.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(65,4,6,'Bridal Makeup',180,824000.00,'Riasan pengantin lengkap dengan trial dan touch-up untuk hari spesialmu.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(66,4,6,'Makeup Wisuda',90,273000.00,'Riasan wisuda elegan yang tahan dari pagi hingga malam.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(67,4,1,'Creambath',60,78000.00,'Perawatan rambut dengan krim nutrisi untuk menjaga kelembapan dan kilau rambut.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(68,4,1,'Hair Mask',45,75000.00,'Masker rambut intensif untuk memperbaiki kerusakan dan menutrisi dari dalam.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(69,4,1,'Keratin Treatment',120,343000.00,'Perawatan keratin untuk meluruskan dan menghaluskan rambut hingga 3 bulan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(70,4,1,'Gunting Rambut',30,59000.00,'Potong rambut sesuai keinginan dengan stylist berpengalaman.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(71,4,1,'Blow Dry & Styling',45,73000.00,'Blow dry dan styling rambut untuk penampilan sempurna sehari-hari.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(72,4,1,'Hair Spa',90,155000.00,'Perawatan spa rambut lengkap dengan pijat kepala, masker, dan kondisioner.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(73,4,3,'Manicure',45,63000.00,'Perawatan kuku tangan lengkap termasuk pembentukan dan pengecatan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(74,4,3,'Pedicure',60,78000.00,'Perawatan kuku kaki lengkap dengan scrub dan moisturizer.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(75,4,3,'Nail Art',60,132000.00,'Desain nail art kreatif sesuai selera dengan berbagai pilihan motif.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(76,4,3,'Gel Nails',90,193000.00,'Cat kuku gel tahan lama hingga 3 minggu tanpa retak.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(77,4,3,'Nail Extension',120,270000.00,'Perpanjangan kuku dengan akrilik atau gel untuk tampilan mewah.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(78,4,3,'Manicure & Pedicure',100,134000.00,'Paket lengkap perawatan kuku tangan dan kaki dengan harga spesial.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(79,4,4,'Basic Facial',60,109000.00,'Pembersihan wajah dasar untuk menjaga kecerahan dan kebersihan kulit.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(80,4,4,'Deep Cleansing Facial',90,180000.00,'Facial pembersihan mendalam untuk mengangkat komedo dan kotoran pori-pori.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(81,4,4,'Brightening Facial',75,216000.00,'Perawatan wajah untuk mencerahkan kulit kusam dan meratakan warna kulit.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(82,4,4,'Anti-Aging Facial',90,253000.00,'Facial anti-penuaan dengan serum kolagen untuk kulit kencang dan elastis.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(83,4,4,'Acne Treatment',60,137000.00,'Perawatan khusus untuk kulit berjerawat dengan teknologi LED therapy.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(84,5,1,'Creambath',60,78000.00,'Perawatan rambut dengan krim nutrisi untuk menjaga kelembapan dan kilau rambut.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(85,5,1,'Hair Mask',45,82000.00,'Masker rambut intensif untuk memperbaiki kerusakan dan menutrisi dari dalam.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(86,5,1,'Keratin Treatment',120,343000.00,'Perawatan keratin untuk meluruskan dan menghaluskan rambut hingga 3 bulan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(87,5,1,'Gunting Rambut',30,59000.00,'Potong rambut sesuai keinginan dengan stylist berpengalaman.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(88,5,1,'Blow Dry & Styling',45,78000.00,'Blow dry dan styling rambut untuk penampilan sempurna sehari-hari.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(89,5,1,'Hair Spa',90,153000.00,'Perawatan spa rambut lengkap dengan pijat kepala, masker, dan kondisioner.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(90,5,2,'Highlight',120,288000.00,'Highlight rambut dengan teknik terkini untuk tampilan segar dan modern.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(91,5,2,'Full Color',90,245000.00,'Mewarnai seluruh rambut dengan pilihan warna terlengkap.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(92,5,2,'Balayage',150,530000.00,'Teknik pewarnaan balayage untuk gradasi warna natural yang elegan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(93,5,2,'Ombre',120,440000.00,'Efek ombre dari gelap ke terang yang trendi dan menawan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(94,5,2,'Bleaching',90,347000.00,'Proses bleaching aman untuk persiapan pewarnaan cerah.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(95,5,3,'Manicure',45,61000.00,'Perawatan kuku tangan lengkap termasuk pembentukan dan pengecatan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(96,5,3,'Pedicure',60,68000.00,'Perawatan kuku kaki lengkap dengan scrub dan moisturizer.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(97,5,3,'Nail Art',60,126000.00,'Desain nail art kreatif sesuai selera dengan berbagai pilihan motif.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(98,5,3,'Gel Nails',90,184000.00,'Cat kuku gel tahan lama hingga 3 minggu tanpa retak.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(99,5,3,'Nail Extension',120,245000.00,'Perpanjangan kuku dengan akrilik atau gel untuk tampilan mewah.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(100,5,3,'Manicure & Pedicure',100,121000.00,'Paket lengkap perawatan kuku tangan dan kaki dengan harga spesial.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(101,5,6,'Makeup Natural',60,202000.00,'Riasan natural sehari-hari yang cantik dan tahan lama.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(102,5,6,'Makeup Party',90,340000.00,'Riasan pesta glamor untuk penampilan memukau di berbagai acara.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(103,5,6,'Bridal Makeup',180,784000.00,'Riasan pengantin lengkap dengan trial dan touch-up untuk hari spesialmu.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(104,5,6,'Makeup Wisuda',90,303000.00,'Riasan wisuda elegan yang tahan dari pagi hingga malam.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(105,6,1,'Creambath',60,87000.00,'Perawatan rambut dengan krim nutrisi untuk menjaga kelembapan dan kilau rambut.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(106,6,1,'Hair Mask',45,68000.00,'Masker rambut intensif untuk memperbaiki kerusakan dan menutrisi dari dalam.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(107,6,1,'Keratin Treatment',120,319000.00,'Perawatan keratin untuk meluruskan dan menghaluskan rambut hingga 3 bulan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(108,6,1,'Gunting Rambut',30,70000.00,'Potong rambut sesuai keinginan dengan stylist berpengalaman.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(109,6,1,'Blow Dry & Styling',45,80000.00,'Blow dry dan styling rambut untuk penampilan sempurna sehari-hari.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(110,6,1,'Hair Spa',90,159000.00,'Perawatan spa rambut lengkap dengan pijat kepala, masker, dan kondisioner.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(111,6,5,'Lulur Tradisional',90,182000.00,'Lulur khas Jawa dengan rempah-rempah pilihan untuk kulit halus bercahaya.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(112,6,5,'Body Scrub',60,155000.00,'Eksfoliasi tubuh menyeluruh untuk mengangkat sel kulit mati.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(113,6,5,'Body Massage',60,150000.00,'Pijat relaksasi tubuh untuk menghilangkan pegal dan stres.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(114,6,5,'Aromatherapy Massage',90,218000.00,'Pijat aromaterapi dengan essential oil pilihan untuk relaksasi total.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(115,6,5,'Body Wrap',90,206000.00,'Perawatan body wrap dengan bahan alami untuk melembapkan dan mengencangkan kulit.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(116,6,5,'Full Body Spa',180,405000.00,'Paket spa lengkap: lulur, masker, pijat, dan mandi susu untuk kesempurnaan perawatan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(117,6,4,'Basic Facial',60,120000.00,'Pembersihan wajah dasar untuk menjaga kecerahan dan kebersihan kulit.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(118,6,4,'Deep Cleansing Facial',90,198000.00,'Facial pembersihan mendalam untuk mengangkat komedo dan kotoran pori-pori.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(119,6,4,'Brightening Facial',75,190000.00,'Perawatan wajah untuk mencerahkan kulit kusam dan meratakan warna kulit.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(120,6,4,'Anti-Aging Facial',90,268000.00,'Facial anti-penuaan dengan serum kolagen untuk kulit kencang dan elastis.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(121,6,4,'Acne Treatment',60,143000.00,'Perawatan khusus untuk kulit berjerawat dengan teknologi LED therapy.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(122,6,8,'Full Leg Waxing',45,126000.00,'Waxing kaki menyeluruh untuk kulit mulus dan halus tahan 3–4 minggu.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(123,6,8,'Underarm Waxing',20,54000.00,'Waxing ketiak untuk membersihkan bulu dengan cepat dan minim nyeri.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(124,6,8,'Full Body Waxing',120,357000.00,'Waxing seluruh tubuh untuk kulit bersih dan halus sempurna.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(125,6,8,'Facial Threading',30,51000.00,'Threading wajah untuk membersihkan bulu halus dan membentuk alis.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(126,7,5,'Lulur Tradisional',90,196000.00,'Lulur khas Jawa dengan rempah-rempah pilihan untuk kulit halus bercahaya.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(127,7,5,'Body Scrub',60,156000.00,'Eksfoliasi tubuh menyeluruh untuk mengangkat sel kulit mati.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(128,7,5,'Body Massage',60,168000.00,'Pijat relaksasi tubuh untuk menghilangkan pegal dan stres.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(129,7,5,'Aromatherapy Massage',90,209000.00,'Pijat aromaterapi dengan essential oil pilihan untuk relaksasi total.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(130,7,5,'Body Wrap',90,220000.00,'Perawatan body wrap dengan bahan alami untuk melembapkan dan mengencangkan kulit.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(131,7,5,'Full Body Spa',180,459000.00,'Paket spa lengkap: lulur, masker, pijat, dan mandi susu untuk kesempurnaan perawatan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(132,7,4,'Basic Facial',60,109000.00,'Pembersihan wajah dasar untuk menjaga kecerahan dan kebersihan kulit.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(133,7,4,'Deep Cleansing Facial',90,176000.00,'Facial pembersihan mendalam untuk mengangkat komedo dan kotoran pori-pori.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(134,7,4,'Brightening Facial',75,210000.00,'Perawatan wajah untuk mencerahkan kulit kusam dan meratakan warna kulit.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(135,7,4,'Anti-Aging Facial',90,255000.00,'Facial anti-penuaan dengan serum kolagen untuk kulit kencang dan elastis.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(136,7,4,'Acne Treatment',60,149000.00,'Perawatan khusus untuk kulit berjerawat dengan teknologi LED therapy.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(137,7,1,'Creambath',60,84000.00,'Perawatan rambut dengan krim nutrisi untuk menjaga kelembapan dan kilau rambut.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(138,7,1,'Hair Mask',45,68000.00,'Masker rambut intensif untuk memperbaiki kerusakan dan menutrisi dari dalam.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(139,7,1,'Keratin Treatment',120,368000.00,'Perawatan keratin untuk meluruskan dan menghaluskan rambut hingga 3 bulan.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(140,7,1,'Gunting Rambut',30,67000.00,'Potong rambut sesuai keinginan dengan stylist berpengalaman.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(141,7,1,'Blow Dry & Styling',45,85000.00,'Blow dry dan styling rambut untuk penampilan sempurna sehari-hari.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(142,7,1,'Hair Spa',90,156000.00,'Perawatan spa rambut lengkap dengan pijat kepala, masker, dan kondisioner.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(143,7,7,'Sulam Alis',120,475000.00,'Sulam alis semi-permanen dengan teknik microblading untuk alis natural sempurna.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(144,7,7,'Eyebrow Threading',15,32000.00,'Pembentukan alis dengan benang untuk hasil rapi dan presisi.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(145,7,7,'Eyelash Extension',90,308000.00,'Sambung bulu mata dengan berbagai pilihan efek: natural, wispy, atau volume.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(146,7,7,'Lash Lift & Tint',60,192000.00,'Angkat dan warnai bulu mata alami untuk tampilan lentik tanpa maskara.','2026-06-09 08:34:46','2026-06-09 08:34:46'),
(147,8,5,'Lulur Tradisional',90,178000.00,'Lulur khas Jawa dengan rempah-rempah pilihan untuk kulit halus bercahaya.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(148,8,5,'Body Scrub',60,159000.00,'Eksfoliasi tubuh menyeluruh untuk mengangkat sel kulit mati.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(149,8,5,'Body Massage',60,165000.00,'Pijat relaksasi tubuh untuk menghilangkan pegal dan stres.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(150,8,5,'Aromatherapy Massage',90,220000.00,'Pijat aromaterapi dengan essential oil pilihan untuk relaksasi total.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(151,8,5,'Body Wrap',90,190000.00,'Perawatan body wrap dengan bahan alami untuk melembapkan dan mengencangkan kulit.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(152,8,5,'Full Body Spa',180,446000.00,'Paket spa lengkap: lulur, masker, pijat, dan mandi susu untuk kesempurnaan perawatan.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(153,8,4,'Basic Facial',60,120000.00,'Pembersihan wajah dasar untuk menjaga kecerahan dan kebersihan kulit.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(154,8,4,'Deep Cleansing Facial',90,193000.00,'Facial pembersihan mendalam untuk mengangkat komedo dan kotoran pori-pori.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(155,8,4,'Brightening Facial',75,212000.00,'Perawatan wajah untuk mencerahkan kulit kusam dan meratakan warna kulit.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(156,8,4,'Anti-Aging Facial',90,270000.00,'Facial anti-penuaan dengan serum kolagen untuk kulit kencang dan elastis.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(157,8,4,'Acne Treatment',60,149000.00,'Perawatan khusus untuk kulit berjerawat dengan teknologi LED therapy.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(158,8,3,'Manicure',45,67000.00,'Perawatan kuku tangan lengkap termasuk pembentukan dan pengecatan.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(159,8,3,'Pedicure',60,78000.00,'Perawatan kuku kaki lengkap dengan scrub dan moisturizer.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(160,8,3,'Nail Art',60,113000.00,'Desain nail art kreatif sesuai selera dengan berbagai pilihan motif.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(161,8,3,'Gel Nails',90,189000.00,'Cat kuku gel tahan lama hingga 3 minggu tanpa retak.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(162,8,3,'Nail Extension',120,228000.00,'Perpanjangan kuku dengan akrilik atau gel untuk tampilan mewah.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(163,8,3,'Manicure & Pedicure',100,127000.00,'Paket lengkap perawatan kuku tangan dan kaki dengan harga spesial.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(164,8,1,'Creambath',60,77000.00,'Perawatan rambut dengan krim nutrisi untuk menjaga kelembapan dan kilau rambut.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(165,8,1,'Hair Mask',45,79000.00,'Masker rambut intensif untuk memperbaiki kerusakan dan menutrisi dari dalam.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(166,8,1,'Keratin Treatment',120,382000.00,'Perawatan keratin untuk meluruskan dan menghaluskan rambut hingga 3 bulan.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(167,8,1,'Gunting Rambut',30,59000.00,'Potong rambut sesuai keinginan dengan stylist berpengalaman.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(168,8,1,'Blow Dry & Styling',45,73000.00,'Blow dry dan styling rambut untuk penampilan sempurna sehari-hari.','2026-06-09 08:34:47','2026-06-09 08:34:47'),
(169,8,1,'Hair Spa',90,141000.00,'Perawatan spa rambut lengkap dengan pijat kepala, masker, dan kondisioner.','2026-06-09 08:34:47','2026-06-09 08:34:47');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('BGhlu4so6jRT9V9HHfPZJa6mBXy8Hlco3sNdCTja',1,'::1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWXUzVTdGVExKNDFQOHdvbXhxbHZIdjlFTURBQXo3YmJGUE1kUUI4QyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9ib29raW5ncy8xL3BheSI7czo1OiJyb3V0ZSI7czoyMToiY3VzdG9tZXIuYm9va2luZ3MucGF5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1781019855),
('CODnKplKQN7BXtggPZd7nvq3VEdmGjLJmK5HsR90',NULL,'127.0.0.1','curl/8.19.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXR0d1NsNDFWZGczM3Bhc3RIY05SR2lyb1IzNGpNTjFhbTkxYTIwSCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781018145);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff` (
  `staff_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `salon_id` bigint(20) unsigned NOT NULL,
  `nama_staff` varchar(255) NOT NULL,
  `spesialisasi` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`staff_id`),
  KEY `staff_salon_id_foreign` (`salon_id`),
  CONSTRAINT `staff_salon_id_foreign` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`salon_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','owner','customer') NOT NULL DEFAULT 'customer',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Dio Saputra','diosaputra20201@gmail.com',NULL,'$2y$12$v.PXei1kw3lGC/X9dgEadeOuuvtuYwTtQDpPJPZvuE9kzlfamhu1.',NULL,'2026-06-09 08:27:10','2026-06-09 08:27:10','customer'),
(2,'Rina Marlina','rina@lumiere.test',NULL,'$2y$12$0QKhBpGsp5KuI06HBfp7Gu4ds7gw63bVUciNyLJ3Ul08diRPyr7Ry',NULL,'2026-06-09 08:32:15','2026-06-09 08:32:15','owner'),
(3,'Dewi Sartika','dewi@lumiere.test',NULL,'$2y$12$JiWVrLJzJDT12k.tMKADWe1rWkbig0wPznWMidOhWCtndwGrzNFCu',NULL,'2026-06-09 08:32:15','2026-06-09 08:32:15','owner'),
(4,'Hana Pratiwi','hana@lumiere.test',NULL,'$2y$12$fH2AIGah4GIZCxdz80A30.jWns7.ZiiyQ0O2zIKl3CwLnljvANcTW',NULL,'2026-06-09 08:32:16','2026-06-09 08:32:16','owner'),
(5,'Siti Nurhaliza','siti@lumiere.test',NULL,'$2y$12$hcT/VIFYw7gAQvSEvxuFnOUhPAAhgkrhjJMgMAQ1bWbN.Q59l0Oy2',NULL,'2026-06-09 08:32:16','2026-06-09 08:32:16','owner'),
(6,'Laras Wulandari','laras@lumiere.test',NULL,'$2y$12$lC4jyUaaiGTHHSajgknHfuEP/jjADk6PMEWxw4Yvdy7.q9gmUgYx6',NULL,'2026-06-09 08:32:16','2026-06-09 08:32:16','owner'),
(7,'Mega Putri','mega@lumiere.test',NULL,'$2y$12$gHjX9sNaz2jhrugY/odspeuBZtf5cpqoVHaKzSLscpaAg/REQG.D.',NULL,'2026-06-09 08:32:16','2026-06-09 08:32:16','owner'),
(8,'Nadia Cahya','nadia@lumiere.test',NULL,'$2y$12$EDtVPf1DXyhdkCSMpQoW3Oj4JlUIqPCHP19BCzCjkgukWxXt2HU02',NULL,'2026-06-09 08:32:17','2026-06-09 08:32:17','owner'),
(9,'Rini Susanti','rini@lumiere.test',NULL,'$2y$12$.u8zq3dsUE09aEQKgnDRce3fKJTA0O8zPwOCvSKrdU59Y3MMGt6xq',NULL,'2026-06-09 08:32:17','2026-06-09 08:32:17','owner'),
(10,'Admin Lumiere','admin@lumiere.test','2026-06-09 09:26:48','$2y$12$IHClT9oC07U9MwPP6u/weubDvZkEn2Ce3XgUMstUi9vZeEJrEmj4a',NULL,'2026-06-09 09:26:49','2026-06-09 09:26:49','admin'),
(11,'Owner Lumiere','owner@lumiere.test','2026-06-09 09:26:49','$2y$12$RBcQyItHe2gXR9gupCAo3elN.1Ez8LYjPQxtiPIKiZcJi8GsH4HPW',NULL,'2026-06-09 09:26:49','2026-06-09 09:26:49','owner'),
(12,'Customer Lumiere','customer@lumiere.test','2026-06-09 09:26:49','$2y$12$41FleuHsDrmZJrN1XWTGjOKFe9dNotzt2tVztHqTviYOTZQA4IbBe',NULL,'2026-06-09 09:26:49','2026-06-09 09:26:49','customer');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

SET FOREIGN_KEY_CHECKS=1;

-- Dump completed on 2026-06-09 23:28:53
