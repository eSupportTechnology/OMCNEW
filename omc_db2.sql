-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.38 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for omc_db2
CREATE DATABASE IF NOT EXISTS `omc_db2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `omc_db2`;

-- Dumping structure for table omc_db2.addresses
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_num` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_user_id_foreign` (`user_id`),
  CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.addresses: ~1 rows (approximately)
REPLACE INTO `addresses` (`id`, `user_id`, `full_name`, `phone_num`, `email`, `address`, `apartment`, `city`, `postal_code`, `default`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'ABC', NULL, 'Colombo', '12345', 1, '2025-05-21 05:16:33', '2025-05-21 05:16:33');

-- Dumping structure for table omc_db2.affiliate_customers
CREATE TABLE IF NOT EXISTS `affiliate_customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DOB` date NOT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NIC` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion_method` json DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_website_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_whatsapp_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `affiliate_customers_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.affiliate_customers: ~0 rows (approximately)

-- Dumping structure for table omc_db2.affiliate_links
CREATE TABLE IF NOT EXISTS `affiliate_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `raffle_ticket_id` bigint unsigned NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `affiliate_links_raffle_ticket_id_foreign` (`raffle_ticket_id`),
  CONSTRAINT `affiliate_links_raffle_ticket_id_foreign` FOREIGN KEY (`raffle_ticket_id`) REFERENCES `raffle_tickets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.affiliate_links: ~0 rows (approximately)

-- Dumping structure for table omc_db2.affiliate_product
CREATE TABLE IF NOT EXISTS `affiliate_product` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `affiliate_link_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `affiliate_product_product_id_foreign` (`product_id`),
  KEY `affiliate_product_affiliate_link_id_foreign` (`affiliate_link_id`),
  CONSTRAINT `affiliate_product_affiliate_link_id_foreign` FOREIGN KEY (`affiliate_link_id`) REFERENCES `affiliate_links` (`id`) ON DELETE CASCADE,
  CONSTRAINT `affiliate_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.affiliate_product: ~0 rows (approximately)

-- Dumping structure for table omc_db2.affiliate_referrals
CREATE TABLE IF NOT EXISTS `affiliate_referrals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `raffle_ticket_id` bigint unsigned NOT NULL,
  `product_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views_count` int NOT NULL DEFAULT '0',
  `referral_count` int NOT NULL DEFAULT '0',
  `product_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `affiliate_commission` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_affiliate_price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `affiliate_referrals_raffle_ticket_id_foreign` (`raffle_ticket_id`),
  CONSTRAINT `affiliate_referrals_raffle_ticket_id_foreign` FOREIGN KEY (`raffle_ticket_id`) REFERENCES `raffle_tickets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.affiliate_referrals: ~0 rows (approximately)

-- Dumping structure for table omc_db2.affiliate_rules
CREATE TABLE IF NOT EXISTS `affiliate_rules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.affiliate_rules: ~0 rows (approximately)

-- Dumping structure for table omc_db2.affiliate_users
CREATE TABLE IF NOT EXISTS `affiliate_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DOB` date NOT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NIC` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion_method` json DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_website_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_whatsapp_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `affiliate_users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.affiliate_users: ~0 rows (approximately)

-- Dumping structure for table omc_db2.aff_customers
CREATE TABLE IF NOT EXISTS `aff_customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NIC` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactno` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `promotion_method` json DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_website_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_whatsapp_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `aff_customers_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.aff_customers: ~0 rows (approximately)

-- Dumping structure for table omc_db2.banners
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.banners: ~2 rows (approximately)
REPLACE INTO `banners` (`id`, `title`, `image_path`, `position`, `is_active`, `created_at`, `updated_at`) VALUES
	(6, 'ghfh', '1747800757_Banner 1.png', 'bottom', 1, '2025-05-05 02:18:26', '2025-05-20 22:42:37'),
	(7, 'Father', '1747800747_Banner 3.png', 'right', 1, '2025-05-05 02:18:43', '2025-05-20 22:42:27'),
	(8, 'A family', '1747800714_Banner 2.png', 'left', 1, '2025-05-05 02:18:59', '2025-05-20 22:41:54');

-- Dumping structure for table omc_db2.brands
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_top_brand` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table omc_db2.brands: ~2 rows (approximately)
REPLACE INTO `brands` (`id`, `name`, `image`, `slug`, `is_top_brand`, `created_at`, `updated_at`) VALUES
	(3, 'Apple', 'brands/ADwVa2Hd0lqRYZdSIZOmd81VbHql0Kz6ulPWNJGU.png', 'apple', 1, '2025-05-18 23:12:30', '2025-05-18 23:14:41'),
	(4, 'Huawei', 'brands/APcuy36L4JhitylRlWarIhnJjzBdDmx1GpSTzKos.png', 'huawei', 1, '2025-05-19 00:17:45', '2025-05-19 00:17:45');

-- Dumping structure for table omc_db2.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.cache: ~0 rows (approximately)

-- Dumping structure for table omc_db2.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.cache_locks: ~0 rows (approximately)

-- Dumping structure for table omc_db2.carousels
CREATE TABLE IF NOT EXISTS `carousels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.carousels: ~3 rows (approximately)
REPLACE INTO `carousels` (`id`, `title`, `image_path`, `is_active`, `created_at`, `updated_at`) VALUES
	(2, 'Abans', '1747800813_Slider 1.png', 1, '2025-05-04 23:59:38', '2025-05-20 22:43:33'),
	(3, 'A family', '1747800823_Slider 2.png', 1, '2025-05-04 23:32:41', '2025-05-20 22:43:43'),
	(6, 'deal', '1747800836_Slider 3.png', 1, '2025-05-04 23:44:07', '2025-05-20 22:43:56');

-- Dumping structure for table omc_db2.cart_items
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_user_id_foreign` (`user_id`),
  CONSTRAINT `cart_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.cart_items: ~5 rows (approximately)
REPLACE INTO `cart_items` (`id`, `user_id`, `product_id`, `quantity`, `size`, `color`, `image`, `created_at`, `updated_at`) VALUES
	(2, 2, 'PRODUCT-9LKT4G', 3, 'xl', '#000000', NULL, '2025-05-06 23:33:22', '2025-05-09 01:09:17'),
	(3, 2, 'PRODUCT-PVB5M9', 1, NULL, 'Black', NULL, '2025-05-07 07:30:50', '2025-05-07 07:30:50'),
	(4, 2, 'PRODUCT-9LKT4G', 3, 'xl', 'Black', NULL, '2025-05-07 10:28:16', '2025-05-07 10:30:26'),
	(5, 2, 'PRODUCT-9LKT4G', 1, 'Xl', '#c32828', NULL, '2025-05-21 01:45:45', '2025-05-21 01:45:45'),
	(6, 2, 'PRODUCT-RJ2ROA', 1, NULL, NULL, NULL, '2025-05-21 01:53:54', '2025-05-21 01:53:54');

-- Dumping structure for table omc_db2.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.categories: ~0 rows (approximately)
REPLACE INTO `categories` (`id`, `parent_category`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'LG', '1746442998_LG.png', '2025-05-02 05:59:59', '2025-05-05 05:33:18');

-- Dumping structure for table omc_db2.contact_messages
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.contact_messages: ~0 rows (approximately)
REPLACE INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
	(1, 'Manula', 'manulakavishka9@gmail.com', '123', '2025-05-05 04:12:51', '2025-05-05 04:12:51');

-- Dumping structure for table omc_db2.customer_order
CREATE TABLE IF NOT EXISTS `customer_order` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `customer_fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `total_cost` decimal(15,2) NOT NULL,
  `status` enum('Confirmed','Paid','In Progress','Shipped','Delivered','Cancelled','Returned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Confirmed',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `transaction_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_order_user_id_foreign` (`user_id`),
  KEY `customer_order_order_code_index` (`order_code`),
  CONSTRAINT `customer_order_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.customer_order: ~46 rows (approximately)
REPLACE INTO `customer_order` (`id`, `order_code`, `user_id`, `customer_fname`, `phone`, `email`, `company_name`, `address`, `apartment`, `city`, `postal_code`, `date`, `total_cost`, `status`, `payment_method`, `payment_status`, `discount`, `transaction_id`, `created_at`, `updated_at`) VALUES
	(1, '123', 1, '123', '123', '123', '123', '123', '123', '123', '123', '2025-05-05', 123.00, 'Confirmed', NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'ORD-4a412b06', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-06', 1200.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-06 01:18:40', '2025-05-06 01:18:40'),
	(3, 'ORD-c1b713fe', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-08', 1200.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-07 22:35:24', '2025-05-07 22:35:24'),
	(4, 'ORD-886fdbdf', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-08', 2200.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-08 00:43:41', '2025-05-08 00:43:41'),
	(5, 'ORD-61b171b0', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-09', 7500.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-08 23:38:08', '2025-05-08 23:38:08'),
	(6, 'ORD-20596d02', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-09', 7500.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-08 23:38:31', '2025-05-08 23:38:31'),
	(7, 'ORD-ac053c5c', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-09', 1200.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-09 00:38:19', '2025-05-09 00:38:19'),
	(8, 'ORD-e6c92234', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-09', 1200.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-09 00:44:07', '2025-05-09 00:44:07'),
	(9, 'ORD-9a43958f', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-09', 2100.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-09 00:53:29', '2025-05-09 00:53:29'),
	(10, 'ORD-1fb87933', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-09', 2100.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-09 00:56:18', '2025-05-09 00:56:18'),
	(11, 'ORD-6ec1f574', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-09', 3900.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-09 01:00:27', '2025-05-09 01:00:27'),
	(12, 'ORD-4c1279dc', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-09', 9300.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-09 01:23:48', '2025-05-09 01:23:48'),
	(13, 'ORD-876c48f9', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-09', 7500.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-09 03:15:08', '2025-05-09 03:15:08'),
	(14, 'ORD-071b7c31', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-09', 2200.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-09 03:35:13', '2025-05-09 03:35:13'),
	(15, 'ORD-628c4c70', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-11', 2200.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-11 09:01:51', '2025-05-11 09:01:51'),
	(16, 'ORD-3c53b1f2', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'Premium Battery', '123/ colombo1212', 'fsd', 'fsdf', 'fsd', '2025-05-14', 9300.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-14 02:46:26', '2025-05-14 02:46:26'),
	(17, 'ORD-bc73cc42', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-19', 1200.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-19 01:56:42', '2025-05-19 01:56:42'),
	(18, 'ORD-0c47c2b6', 2, 'KALUPATHIRENNEHELAGE', '0234234324', 'a@gmail.com', 'abc', '123', 'fsd', 'fsdf', 'fsd', '2025-05-19', 2200.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-19 05:06:15', '2025-05-19 05:06:15'),
	(19, 'ORD-e81761ea', 2, 'Manula', '0234234324', 'manulakavishka@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-19', 1200.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-19 05:21:34', '2025-05-19 05:21:34'),
	(20, 'ORD-831457f9', 2, 'Manula', '0234234324', 'manulakavishka@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-19', 1200.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-19 05:31:00', '2025-05-19 05:31:00'),
	(21, 'ORD-5d5d63ad', 2, 'asd', '0234234324', 'manula@gmail.com', 'abc', '123/ colombo1212', 'fsd', 'fsdf', 'fsd', '2025-05-20', 3900.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-19 22:35:13', '2025-05-19 22:35:13'),
	(22, 'ORD-3be1233c', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'abc', '123/ colombo1212', 'fsd', 'fsdf', 'fsd', '2025-05-20', 9300.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-19 22:36:25', '2025-05-19 22:36:25'),
	(23, 'ORD-645abb93', 3, 'asd', '0234234324', 'manula@gmail.com', 'abc', '123/ colombo1212', 'fsd', 'fsdf', 'fsd', '2025-05-20', 2200.00, 'Confirmed', 'COD', 'Not Paid', 0.00, NULL, '2025-05-20 01:19:11', '2025-05-20 01:20:20'),
	(24, 'ORD-2d478cda', 2, 'asd', '0234234324', 'manula@gmail.com', 'abc', '123/ colombo1212', 'fsd', 'fsdf', 'fsd', '2025-05-21', 1200.00, 'Confirmed', 'Card', 'Paid', 0.00, 'DSA_682daced3ad52', '2025-05-21 04:36:03', '2025-05-21 05:07:34'),
	(25, 'ORD-983b3d11', 2, 'Manula', '0234234324', 'manulakavishka@gmail.com', 'asdf', 'sd', '123', '123', '123', '2025-05-21', 2200.00, 'Confirmed', 'Card', 'Paid', 0.00, 'DSA_682dadf644e0b', '2025-05-21 05:11:54', '2025-05-21 05:12:04'),
	(26, 'ORD-a15ac743', 2, 'Manula', '0766899518', 'manulakavishka9@gmail.com', NULL, 'ABC', 'ABC', 'Colombo', '12345', '2025-05-21', 1200.00, 'Confirmed', 'Card', 'Paid', 0.00, 'DSA_682daf553ed89', '2025-05-21 05:17:44', '2025-05-21 05:17:50'),
	(27, 'ORD-60828a98', 2, 'Manula Kavishka', '0234234324', 'manulakavishka9@gmail.com', NULL, 'ABC', '123', 'Colombo', '12345', '2025-05-21', 2200.00, 'Confirmed', 'Card', 'Paid', 0.00, 'DSA_682db119e63e9', '2025-05-21 05:25:17', '2025-05-21 05:25:22'),
	(28, 'ORD-270fabcf', 2, 'Manula Kavishka', '0234234324', 'manulakavishka9@gmail.com', NULL, 'ABC', '123', 'Colombo', '12345', '2025-05-21', 1300.00, 'Confirmed', 'Card', 'Paid', 0.00, 'DSA_682db1e5b8af1', '2025-05-21 05:28:42', '2025-05-21 05:28:46'),
	(29, 'ORD-a4e8980b', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', NULL, 'ABC', '123', 'Colombo', '12345', '2025-05-21', 1200.00, 'Confirmed', 'Card', 'Paid', 0.00, 'DSA_682db4d894a3b', '2025-05-21 05:40:24', '2025-05-21 05:41:21'),
	(30, 'ORD-34efab79', 2, 'Manula Kavishka', '0234234324', 'manulakavishka9@gmail.com', NULL, 'ABC', '123', 'Colombo', '12345', '2025-05-21', 2200.00, 'Confirmed', 'Card', 'Pending', 0.00, 'DSA_682dbadfd3d06', '2025-05-21 06:00:57', '2025-05-21 06:07:04'),
	(31, 'ORD-d75c48cb', 2, 'Manula Kavishka', '0234234324', 'manulakavishka9@gmail.com', NULL, 'ABC', '123', 'Colombo', '12345', '2025-05-21', 2200.00, 'Confirmed', 'Card', 'Paid', 0.00, 'DSA_682dbbdec55ba', '2025-05-21 06:11:06', '2025-05-21 06:11:20'),
	(32, 'ORD-270ca50e', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'abc', 'ABC', 'fsd', 'Colombo', '12345', '2025-05-22', 1300.00, 'Confirmed', NULL, NULL, 0.00, NULL, '2025-05-21 22:41:17', '2025-05-21 22:41:17'),
	(33, 'ORD-2a3d5290', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'abc', 'ABC', 'fsd', 'Colombo', '12345', '2025-05-22', 2200.00, 'Confirmed', 'Card', 'Pending', 0.00, 'DSA_682eed5ae4e59', '2025-05-22 03:54:23', '2025-05-22 03:54:49'),
	(34, 'ORD-e64b0b07', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'abc', 'ABC', 'fsd', 'Colombo', '12345', '2025-05-22', 3900.00, 'Confirmed', 'Card', 'Pending', 0.00, 'DSA_682ef3e3ce2ea', '2025-05-22 04:22:07', '2025-05-22 04:22:39'),
	(35, 'ORD-eb873147', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'abc', 'ABC', 'fsd', 'Colombo', '12345', '2025-05-22', 2200.00, 'Confirmed', 'Card', 'Pending', 0.00, 'DSA_682ef5f158980', '2025-05-22 04:31:01', '2025-05-22 04:31:22'),
	(36, 'ORD-f39a0412', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', NULL, 'ABC', NULL, 'Colombo', '12345', '2025-05-22', 2200.00, 'Confirmed', 'Card', 'Pending', 0.00, 'DSA_682ef76e9ffee', '2025-05-22 04:36:46', '2025-05-22 04:37:44'),
	(37, 'ORD-7153e0e9', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'abc', 'ABC', 'fsd', 'Colombo', '12345', '2025-05-22', 2200.00, 'Confirmed', 'Card', 'Pending', 0.00, 'DSA_682efd263942d', '2025-05-22 05:01:39', '2025-05-22 05:02:07'),
	(38, 'ORD-cab2e1b3', 2, 'Manula', '0234234324', 'manulakavishka9@gmail.com', 'abc', 'ABC', 'fsd', 'Colombo', '12345', '2025-05-22', 2200.00, 'Confirmed', 'Card', 'Pending', 0.00, 'DSA_682eff00cfe78', '2025-05-22 05:09:44', '2025-05-22 05:10:01'),
	(39, 'ORD-36c3e11b', 2, 'Manula', '+94752538738', 'manulakavishka9@gmail.com', 'ABC Company', 'ABC', 'ABC', 'Colombo', '12345', '2025-05-22', 1200.00, 'Confirmed', 'Card', 'Pending', 0.00, 'DSA_682f00aab46f2', '2025-05-22 05:16:53', '2025-05-22 05:17:09'),
	(40, 'ORD-b7a079fd', 2, 'Manula', '+94752538738', 'manulakavishka9@gmail.com', 'abc', 'ABC', 'fsd', 'Colombo', '12345', '2025-05-22', 1300.00, 'Confirmed', 'Card', 'Pending', 0.00, 'DSA_682f06f1855a3', '2025-05-22 05:43:29', '2025-05-22 05:43:56'),
	(41, 'ORD-199881aa', 2, 'Manula', '+94752538738', 'manulakavishka9@gmail.com', 'abc', 'ABC', 'fsd', 'Colombo', '12345', '2025-05-22', 1200.00, 'Confirmed', 'Card', 'Pending', 0.00, 'DSA_682f07cbabca3', '2025-05-22 05:46:48', '2025-05-22 05:47:33'),
	(42, 'ORD-cde3b204', 2, 'Manula', '+94752538738', 'manulakavishka9@gmail.com', 'abc', 'ABC', 'fsd', 'Colombo', '12345', '2025-05-22', 2200.00, 'Confirmed', 'Card', 'Pending', 0.00, 'DSA_682f09d581e60', '2025-05-22 05:56:10', '2025-05-22 05:56:16'),
	(43, 'ORD-ae7f135f', 2, 'Manula', '+94752538738', 'manulakavishka9@gmail.com', 'abc', 'ABC', 'fsd', 'Colombo', '12345', '2025-05-22', 2200.00, 'Confirmed', 'Card', 'Pending', 0.00, 'DSA_682f0a9b39c69', '2025-05-22 05:59:25', '2025-05-22 05:59:32'),
	(44, 'ORD-7e553baa', 2, 'Manula', '+94752538738', 'manulakavishka9@gmail.com', NULL, 'ABC', NULL, 'Colombo', '12345', '2025-05-23', 3900.00, 'Confirmed', 'Card', 'Pending', 0.00, 'DSA_682fef9421b5d', '2025-05-22 22:16:22', '2025-05-22 22:16:30'),
	(45, 'ORD-bc35db05', 2, 'Manula', '+94752538738', 'manulakavishka9@gmail.com', NULL, 'ABC', NULL, 'Colombo', '12345', '2025-05-23', 3900.00, 'Confirmed', 'Card', 'Pending', 0.00, 'DSA_682ff0f501e41', '2025-05-22 22:21:13', '2025-05-22 22:22:21'),
	(46, 'ORD-8ce4e1c5', 2, 'Manula', '+94752538738', 'manulakavishka9@gmail.com', NULL, 'ABC', NULL, 'Colombo', '12345', '2025-05-23', 3900.00, 'Confirmed', 'Card', 'Paid', 0.00, 'DSA_682ff8644ee49', '2025-05-22 22:44:36', '2025-05-22 22:54:38');

-- Dumping structure for table omc_db2.customer_order_items
CREATE TABLE IF NOT EXISTS `customer_order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `cost` decimal(15,2) NOT NULL,
  `reviewed` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_order_items_id_unique` (`id`),
  KEY `customer_order_items_order_code_index` (`order_code`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.customer_order_items: ~49 rows (approximately)
REPLACE INTO `customer_order_items` (`id`, `order_code`, `product_id`, `quantity`, `size`, `color`, `date`, `cost`, `reviewed`, `created_at`, `updated_at`) VALUES
	(1, '123', 'PRODUCT-9LKT4G', 1, 'xl', 'red', '2025-05-05', 100.00, 'no', '2025-05-05 11:21:27', '2025-05-05 11:21:28'),
	(2, 'ORD-4a412b06', 'PRODUCT-9LKT4G', 1, 'xl', '#000000', '2025-05-06', 900.00, 'no', '2025-05-06 01:18:40', '2025-05-06 01:18:40'),
	(3, 'ORD-c1b713fe', 'PRODUCT-9LKT4G', 1, 'xl', 'Black', '2025-05-08', 900.00, 'no', '2025-05-07 22:35:24', '2025-05-07 22:35:24'),
	(4, 'ORD-886fdbdf', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-08', 1900.00, 'no', '2025-05-08 00:43:41', '2025-05-08 00:43:41'),
	(5, 'ORD-61b171b0', 'PRODUCT-PVB5M9', 2, NULL, 'Black', '2025-05-09', 3600.00, 'no', '2025-05-08 23:38:08', '2025-05-08 23:38:08'),
	(6, 'ORD-20596d02', 'PRODUCT-PVB5M9', 2, NULL, 'Black', '2025-05-09', 3600.00, 'no', '2025-05-08 23:38:31', '2025-05-08 23:38:31'),
	(7, 'ORD-ac053c5c', 'PRODUCT-9LKT4G', 1, 'xl', 'Black', '2025-05-09', 900.00, 'no', '2025-05-09 00:38:19', '2025-05-09 00:38:19'),
	(8, 'ORD-e6c92234', 'PRODUCT-9LKT4G', 1, 'xl', 'Black', '2025-05-09', 900.00, 'no', '2025-05-09 00:44:07', '2025-05-09 00:44:07'),
	(9, 'ORD-9a43958f', 'PRODUCT-9LKT4G', 2, NULL, NULL, '2025-05-09', 900.00, 'no', '2025-05-09 00:53:29', '2025-05-09 00:53:29'),
	(10, 'ORD-1fb87933', 'PRODUCT-9LKT4G', 2, NULL, NULL, '2025-05-09', 900.00, 'no', '2025-05-09 00:56:18', '2025-05-09 00:56:18'),
	(11, 'ORD-6ec1f574', 'PRODUCT-PVB5M9', 1, NULL, 'Black', '2025-05-09', 3600.00, 'no', '2025-05-09 01:00:27', '2025-05-09 01:00:27'),
	(12, 'ORD-4c1279dc', 'PRODUCT-9LKT4G', 3, 'xl', '#000000', '2025-05-09', 900.00, 'no', '2025-05-09 01:23:49', '2025-05-09 01:23:49'),
	(13, 'ORD-4c1279dc', 'PRODUCT-PVB5M9', 1, NULL, 'Black', '2025-05-09', 3600.00, 'no', '2025-05-09 01:23:49', '2025-05-09 01:23:49'),
	(14, 'ORD-4c1279dc', 'PRODUCT-9LKT4G', 3, 'xl', 'Black', '2025-05-09', 900.00, 'no', '2025-05-09 01:23:49', '2025-05-09 01:23:49'),
	(15, 'ORD-876c48f9', 'PRODUCT-PVB5M9', 2, NULL, NULL, '2025-05-09', 3600.00, 'no', '2025-05-09 03:15:08', '2025-05-09 03:15:08'),
	(16, 'ORD-071b7c31', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-09', 1900.00, 'no', '2025-05-09 03:35:13', '2025-05-09 03:35:13'),
	(17, 'ORD-628c4c70', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-11', 1900.00, 'no', '2025-05-11 09:01:51', '2025-05-11 09:01:51'),
	(18, 'ORD-3c53b1f2', 'PRODUCT-9LKT4G', 3, 'xl', '#000000', '2025-05-14', 900.00, 'no', '2025-05-14 02:46:26', '2025-05-14 02:46:26'),
	(19, 'ORD-3c53b1f2', 'PRODUCT-PVB5M9', 1, NULL, 'Black', '2025-05-14', 3600.00, 'no', '2025-05-14 02:46:26', '2025-05-14 02:46:26'),
	(20, 'ORD-3c53b1f2', 'PRODUCT-9LKT4G', 3, 'xl', 'Black', '2025-05-14', 900.00, 'no', '2025-05-14 02:46:26', '2025-05-14 02:46:26'),
	(21, 'ORD-bc73cc42', 'PRODUCT-9LKT4G', 1, NULL, NULL, '2025-05-19', 900.00, 'no', '2025-05-19 01:56:42', '2025-05-19 01:56:42'),
	(22, 'ORD-0c47c2b6', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-19', 1900.00, 'no', '2025-05-19 05:06:15', '2025-05-19 05:06:15'),
	(23, 'ORD-e81761ea', 'PRODUCT-9LKT4G', 1, NULL, NULL, '2025-05-19', 900.00, 'no', '2025-05-19 05:21:34', '2025-05-19 05:21:34'),
	(24, 'ORD-831457f9', 'PRODUCT-9LKT4G', 1, NULL, NULL, '2025-05-19', 900.00, 'no', '2025-05-19 05:31:00', '2025-05-19 05:31:00'),
	(25, 'ORD-5d5d63ad', 'PRODUCT-PVB5M9', 1, NULL, NULL, '2025-05-20', 3600.00, 'no', '2025-05-19 22:35:13', '2025-05-19 22:35:13'),
	(26, 'ORD-3be1233c', 'PRODUCT-9LKT4G', 3, 'xl', '#000000', '2025-05-20', 900.00, 'no', '2025-05-19 22:36:25', '2025-05-19 22:36:25'),
	(27, 'ORD-3be1233c', 'PRODUCT-PVB5M9', 1, NULL, 'Black', '2025-05-20', 3600.00, 'no', '2025-05-19 22:36:25', '2025-05-19 22:36:25'),
	(28, 'ORD-3be1233c', 'PRODUCT-9LKT4G', 3, 'xl', 'Black', '2025-05-20', 900.00, 'no', '2025-05-19 22:36:25', '2025-05-19 22:36:25'),
	(29, 'ORD-645abb93', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-20', 1900.00, 'no', '2025-05-20 01:19:11', '2025-05-20 01:19:11'),
	(30, 'ORD-2d478cda', 'PRODUCT-9LKT4G', 1, 'Xl', 'Tall Poppy', '2025-05-21', 900.00, 'no', '2025-05-21 04:36:03', '2025-05-21 04:36:03'),
	(31, 'ORD-983b3d11', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-21', 1900.00, 'no', '2025-05-21 05:11:54', '2025-05-21 05:11:54'),
	(32, 'ORD-a15ac743', 'PRODUCT-9LKT4G', 1, 'Xl', 'Tall Poppy', '2025-05-21', 900.00, 'no', '2025-05-21 05:17:44', '2025-05-21 05:17:44'),
	(33, 'ORD-60828a98', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-21', 1900.00, 'no', '2025-05-21 05:25:17', '2025-05-21 05:25:17'),
	(34, 'ORD-270fabcf', 'PRODUCT-8BYSDO', 1, NULL, NULL, '2025-05-21', 1000.00, 'no', '2025-05-21 05:28:42', '2025-05-21 05:28:42'),
	(35, 'ORD-a4e8980b', 'PRODUCT-9LKT4G', 1, 'Xl', 'Tall Poppy', '2025-05-21', 900.00, 'no', '2025-05-21 05:40:24', '2025-05-21 05:40:24'),
	(36, 'ORD-34efab79', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-21', 1900.00, 'no', '2025-05-21 06:00:57', '2025-05-21 06:00:57'),
	(37, 'ORD-d75c48cb', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-21', 1900.00, 'no', '2025-05-21 06:11:06', '2025-05-21 06:11:06'),
	(38, 'ORD-270ca50e', 'PRODUCT-8BYSDO', 1, NULL, NULL, '2025-05-22', 1000.00, 'no', '2025-05-21 22:41:17', '2025-05-21 22:41:17'),
	(39, 'ORD-2a3d5290', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-22', 1900.00, 'no', '2025-05-22 03:54:23', '2025-05-22 03:54:23'),
	(40, 'ORD-e64b0b07', 'PRODUCT-PVB5M9', 1, NULL, NULL, '2025-05-22', 3600.00, 'no', '2025-05-22 04:22:07', '2025-05-22 04:22:07'),
	(41, 'ORD-eb873147', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-22', 1900.00, 'no', '2025-05-22 04:31:01', '2025-05-22 04:31:01'),
	(42, 'ORD-f39a0412', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-22', 1900.00, 'no', '2025-05-22 04:36:46', '2025-05-22 04:36:46'),
	(43, 'ORD-7153e0e9', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-22', 1900.00, 'no', '2025-05-22 05:01:39', '2025-05-22 05:01:39'),
	(44, 'ORD-cab2e1b3', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-22', 1900.00, 'no', '2025-05-22 05:09:44', '2025-05-22 05:09:44'),
	(45, 'ORD-36c3e11b', 'PRODUCT-9LKT4G', 1, NULL, 'Tall Poppy', '2025-05-22', 900.00, 'no', '2025-05-22 05:16:53', '2025-05-22 05:16:53'),
	(46, 'ORD-b7a079fd', 'PRODUCT-8BYSDO', 1, NULL, NULL, '2025-05-22', 1000.00, 'no', '2025-05-22 05:43:29', '2025-05-22 05:43:29'),
	(47, 'ORD-199881aa', 'PRODUCT-9LKT4G', 1, NULL, NULL, '2025-05-22', 900.00, 'no', '2025-05-22 05:46:49', '2025-05-22 05:46:49'),
	(48, 'ORD-cde3b204', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-22', 1900.00, 'no', '2025-05-22 05:56:10', '2025-05-22 05:56:10'),
	(49, 'ORD-ae7f135f', 'PRODUCT-RJ2ROA', 1, NULL, NULL, '2025-05-22', 1900.00, 'no', '2025-05-22 05:59:25', '2025-05-22 05:59:25'),
	(50, 'ORD-7e553baa', 'PRODUCT-PVB5M9', 1, NULL, NULL, '2025-05-23', 3600.00, 'no', '2025-05-22 22:16:22', '2025-05-22 22:16:22'),
	(51, 'ORD-bc35db05', 'PRODUCT-PVB5M9', 1, NULL, NULL, '2025-05-23', 3600.00, 'no', '2025-05-22 22:21:13', '2025-05-22 22:21:13'),
	(52, 'ORD-8ce4e1c5', 'PRODUCT-PVB5M9', 1, NULL, NULL, '2025-05-23', 3600.00, 'no', '2025-05-22 22:44:36', '2025-05-22 22:44:36');

-- Dumping structure for table omc_db2.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table omc_db2.inquiries
CREATE TABLE IF NOT EXISTS `inquiries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci,
  `status` enum('Not replied','Replied') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not replied',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inquiries_user_id_foreign` (`user_id`),
  CONSTRAINT `inquiries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.inquiries: ~0 rows (approximately)

-- Dumping structure for table omc_db2.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.jobs: ~0 rows (approximately)

-- Dumping structure for table omc_db2.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.job_batches: ~0 rows (approximately)

-- Dumping structure for table omc_db2.logos
CREATE TABLE IF NOT EXISTS `logos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.logos: ~0 rows (approximately)
REPLACE INTO `logos` (`id`, `title`, `image_path`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Father', '1746528761_brand_name l - Copy.png', 1, '2025-05-05 02:52:34', '2025-05-06 05:22:41');

-- Dumping structure for table omc_db2.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.migrations: ~36 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(34, '0001_01_01_000000_create_users_table', 1),
	(35, '0001_01_01_000001_create_cache_table', 1),
	(36, '0001_01_01_000002_create_jobs_table', 1),
	(37, '2024_08_08_102036_create_customer_order_table', 1),
	(38, '2024_08_08_102906_create_customer_order_items_table', 1),
	(39, '2024_08_15_040608_create_products_table', 1),
	(40, '2024_09_04_051949_create_product_images_table', 1),
	(41, '2024_09_05_095923_create_subcategories_table', 1),
	(42, '2024_09_05_100000_create_sub_subcategories_table', 1),
	(43, '2024_09_05_100616_create_categories_table', 1),
	(44, '2024_09_09_045718_create_cart_items_table', 1),
	(45, '2024_09_13_053100_create_variations_table', 1),
	(46, '2024_09_23_093128_create_system_users_table', 1),
	(47, '2024_09_25_082015_create_reviews_table', 1),
	(48, '2024_09_26_102603_create_aff_customer_table', 1),
	(49, '2024_09_26_102719_add_additional_fields_to_aff_customers_table', 1),
	(50, '2024_09_27_034534_create_review_media_table', 1),
	(51, '2024_09_30_050222_create_special_offers_table', 1),
	(52, '2024_10_01_050131_create_affiliate_users_table', 1),
	(53, '2024_10_01_071603_create_raffle_tickets_table', 1),
	(54, '2024_10_03_063709_create_sales_table', 1),
	(55, '2024_10_04_100324_create_affiliate_customers_table', 1),
	(56, '2024_10_08_172254_create_addresses_table', 1),
	(57, '2024_10_09_034028_create_inquiries_table', 1),
	(58, '2024_10_09_062128_create_affiliate_links_table', 1),
	(59, '2024_10_09_062408_create_affiliate_referrals_table', 1),
	(60, '2024_10_10_073740_create_affiliate_product_table', 1),
	(61, '2024_10_15_120300_create_payment_requests_table', 1),
	(62, '2024_10_24_052404_create_affiliate_rules_table', 1),
	(63, '2024_10_26_000219_add_total_affiliate_price_to_affiliate_referrals_table', 1),
	(64, '2024_12_10_044232_create_contact_messages_table', 1),
	(65, '2024_12_24_072404_create_wish_lists_table', 1),
	(66, '2024_12_26_093724_update_inquiries_table_make_email_phone_nullable', 1),
	(67, '2025_05_02_111321_create_carousels_table', 1),
	(68, '2025_05_02_111510_create_banners_table', 1),
	(69, '2025_05_02_111535_create_logos_table', 1);

-- Dumping structure for table omc_db2.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table omc_db2.payment_requests
CREATE TABLE IF NOT EXISTS `payment_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `withdraw_amount` decimal(10,2) NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processing_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paid_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `requested_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.payment_requests: ~0 rows (approximately)

-- Dumping structure for table omc_db2.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci,
  `brand_id` bigint unsigned DEFAULT NULL,
  `product_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subcategory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_subcategory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `normal_price` decimal(15,2) NOT NULL,
  `is_affiliate` tinyint(1) NOT NULL DEFAULT '0',
  `affiliate_price` decimal(15,2) DEFAULT NULL,
  `commission_percentage` decimal(5,2) DEFAULT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_product_id_unique` (`product_id`),
  KEY `fk_products_brands1_idx` (`brand_id`),
  CONSTRAINT `fk_products_brands1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.products: ~4 rows (approximately)
REPLACE INTO `products` (`id`, `product_id`, `product_name`, `product_description`, `brand_id`, `product_category`, `subcategory`, `sub_subcategory`, `quantity`, `tags`, `normal_price`, `is_affiliate`, `affiliate_price`, `commission_percentage`, `total_price`, `created_at`, `updated_at`) VALUES
	(1, 'PRODUCT-9LKT4G', 'Casual Shoes Loafers British Leather Sneakers', '<p><span style="color: rgb(67, 70, 73);">Per le dimensioni</span></p><p><span style="color: rgb(67, 70, 73);">Si prega di scegliere le dimensioni in base alla lunghezza del piede (dal tallone alla punta)!</span></p><p><span style="color: rgb(67, 70, 73);">Il materiale diverso del paese ha uno standard di diverse dimensioni.</span></p><p><span style="color: rgb(67, 70, 73);">Così la nostra taglia usa, la taglia europea potrebbe essere diversa con la tua.</span></p>', NULL, 'LG', 'Phones', '', 80, 'Whether,with,metal,toe,cap', 1000.00, 1, 1000.00, 10.00, 1100.00, '2025-05-02 06:00:52', '2025-05-22 05:46:49'),
	(2, 'PRODUCT-PVB5M9', 'New Trendy All-match Platform', '<p><span style="color: rgb(67, 70, 73);">Così la nostra taglia usa, la taglia europea potrebbe essere diversa con la tua.</span></p><p><span style="color: rgb(67, 70, 73);">Misura la lunghezza del piede prima e poi scegli la misura corrispondente.</span></p><p><span style="color: rgb(67, 70, 73);">Il numero di dimensioni contrassegnato nella suola della scarpa è il numero di dimensioni della cina, non la dimensione europea.</span></p><p><span style="color: rgb(67, 70, 73);">Aberrazione cromatica</span></p>', 0, 'LG', 'Laptops', '', 420, '43', 4000.00, 0, NULL, NULL, 4000.00, '2025-05-02 06:01:32', '2025-05-22 22:44:36'),
	(3, 'PRODUCT-RJ2ROA', '20pcs Wooden Candles Wick DIY Candle Making Kit Smokeless Candle Core with Clip Base Handmade Candle Wood Core Candlewick', '<p><strong style="color: rgb(0, 0, 0);">20pcs Wooden Candles Wick DIY Candle Making Kit Smokeless Candle Core with Clip Base Handmade Candle Wood Core Candlewick</strong></p><p><span class="ql-cursor">﻿</span>Features: Wooden Candles Wick</p><p>Specification: Wooden Candles Wick for Candle Making Kit</p><p>Package includes：20pcs/pack, 3 sheets Candle Wick Stickers</p><p>Size: 6*60mm,13*130mm,15*150mm</p>', 0, 'LG', 'Phones', 'LG 101', 84, '', 2000.00, 0, NULL, NULL, 2000.00, '2025-05-07 10:52:40', '2025-05-22 05:59:25'),
	(4, 'PRODUCT-8BYSDO', '4 Ports USB C PD Charger Quick Charge 3.0 Type C USB Phone Chargers Fast Charging Adapter For iPhone 15 14 Samsung Xiaomi Huawei', '<p><strong style="color: rgb(0, 0, 0);">4 Ports USB C PD Charger Quick Charge 3.0 Type C USB Phone Chargers Fast Charging Adapter For iPhone 15 14 Samsung Xiaomi Huawei</strong></p>', 4, 'LG', 'Phones', '', 97, 'Top Selling', 1000.00, 0, NULL, NULL, 1000.00, '2025-05-19 00:14:20', '2025-05-22 05:43:29');

-- Dumping structure for table omc_db2.product_images
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.product_images: ~8 rows (approximately)
REPLACE INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
	(3, 'PRODUCT-PVB5M9', 'product_images/1746443262_1726654559_d1 (1).png', '2025-05-05 05:37:42', '2025-05-05 05:37:42'),
	(4, 'PRODUCT-PVB5M9', 'product_images/1746443262_1726654863_d (1).png', '2025-05-05 05:37:42', '2025-05-05 05:37:42'),
	(5, 'PRODUCT-9LKT4G', 'product_images/1746443282_1726656996_baby4.jpg', '2025-05-05 05:38:02', '2025-05-05 05:38:02'),
	(6, 'PRODUCT-9LKT4G', 'product_images/1746443282_1726717424_baby3.jpg', '2025-05-05 05:38:02', '2025-05-05 05:38:02'),
	(7, 'PRODUCT-9LKT4G', 'product_images/1746443315_1726655146_dress5.jpg', '2025-05-05 05:38:35', '2025-05-05 05:38:35'),
	(8, 'PRODUCT-RJ2ROA', 'product_images/1746634960_1727420889_617OBlRSVTL._AC_UF1000,1000_QL80_.jpg', '2025-05-07 10:52:41', '2025-05-07 10:52:41'),
	(9, 'PRODUCT-RJ2ROA', 'product_images/1746634961_1727683575_baby4.jpg', '2025-05-07 10:52:41', '2025-05-07 10:52:41'),
	(10, 'PRODUCT-8BYSDO', 'product_images/1747633460_1746782490_public (1).png', '2025-05-19 00:14:20', '2025-05-19 00:14:20');

-- Dumping structure for table omc_db2.raffle_tickets
CREATE TABLE IF NOT EXISTS `raffle_tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Active','Used','Expired') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `raffle_tickets_token_unique` (`token`),
  KEY `raffle_tickets_user_id_foreign` (`user_id`),
  CONSTRAINT `raffle_tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `affiliate_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.raffle_tickets: ~0 rows (approximately)

-- Dumping structure for table omc_db2.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','published','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `is_anonymous` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.reviews: ~0 rows (approximately)

-- Dumping structure for table omc_db2.review_media
CREATE TABLE IF NOT EXISTS `review_media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `review_id` bigint unsigned NOT NULL,
  `media_type` enum('image','video') COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `review_media_review_id_foreign` (`review_id`),
  CONSTRAINT `review_media_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.review_media: ~0 rows (approximately)

-- Dumping structure for table omc_db2.sales
CREATE TABLE IF NOT EXISTS `sales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `normal_price` decimal(10,2) NOT NULL,
  `sale_rate` decimal(5,2) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `end_date` datetime NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.sales: ~0 rows (approximately)
REPLACE INTO `sales` (`id`, `product_id`, `normal_price`, `sale_rate`, `sale_price`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'PRODUCT-PVB5M9', 4000.00, 10.00, 3600.00, '2025-05-30 16:48:00', 'active', '2025-05-05 05:49:07', '2025-05-21 01:58:24');

-- Dumping structure for table omc_db2.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.sessions: ~4 rows (approximately)
REPLACE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('5kOk3XRYyL7LwZr2s6T9mWMEHPOrRKPphoFkx8a4', NULL, '127.0.0.1', 'onepay/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUZyeU1TdGNsTVFEeWZXVmlDZFlFS1RDeFp5VzlZMHVhMjZ5YXVzVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly82NzA4LTExMi0xMzQtMjIyLTc2Lm5ncm9rLWZyZWUuYXBwL3BheW1lbnQtZmFpbCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747972389),
	('cOQuhJdMQcI00hDKuQTTjMVOQiRntzOw9LLpWGfC', NULL, '127.0.0.1', 'onepay/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibHp5MzVwS1p2clBlUVJ4cHFqeHZSRTF5bHJRUzF5TkFNNDhmNFBYRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly82NzA4LTExMi0xMzQtMjIyLTc2Lm5ncm9rLWZyZWUuYXBwL3BheW1lbnQtZmFpbCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747974198),
	('Duni67NbOPXcYUOpBNfIflopmSqP9tdFkZSMcI0F', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUXdjQUVFaFdFbTk3d1dyekxaR1VKSEtDVW42dlRYd1N4a01IMXU2QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0L2NvdW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjEyOiJwcm9kdWN0X2RhdGEiO2E6Njp7czoxMDoicHJvZHVjdF9pZCI7czoxNDoiUFJPRFVDVC1QVkI1TTkiO3M6MTI6InByb2R1Y3RfbmFtZSI7czoyOToiTmV3IFRyZW5keSBBbGwtbWF0Y2ggUGxhdGZvcm0iO3M6NToicHJpY2UiO3M6NzoiMzYwMC4wMCI7czo0OiJzaXplIjtOO3M6NToiY29sb3IiO047czo4OiJxdWFudGl0eSI7czoxOiIxIjt9fQ==', 1747973788),
	('tIAcwnJyFfXN13oAota4nwEsPGvhwyxVYkWX9qIZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiQmgyUldIYWhoWUczeFVkeUF2U2liMlkwa2ZQY3RabDNBcTE0SVlMSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjg6ImlzX2FkbWluIjtiOjE7czo0OiJuYW1lIjtzOjM6IjEyMyI7czo1OiJlbWFpbCI7czoyNToibWFudWxha2F2aXNoa2E3QGdtYWlsLmNvbSI7czoxMDoiaW1hZ2VfcGF0aCI7czo5OiJSZWFjdC5wbmciO30=', 1747970932),
	('WVIo9iKelk6tktxguk25mtI5GcxwIB4dTFtuvK5H', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiczJKUjBFWnVpV2FabzBJSllwcWtsR2JWUWNSSTZGQTkyU0gxb0wzTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzU6Imh0dHA6Ly82NzA4LTExMi0xMzQtMjIyLTc2Lm5ncm9rLWZyZWUuYXBwL29yZGVyL29yZGVyX3JlY2VpdmVkL09SRC04Y2U0ZTFjNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1747974289);

-- Dumping structure for table omc_db2.special_offers
CREATE TABLE IF NOT EXISTS `special_offers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `normal_price` decimal(8,2) NOT NULL,
  `offer_rate` decimal(5,2) NOT NULL,
  `offer_price` decimal(8,2) NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.special_offers: ~0 rows (approximately)
REPLACE INTO `special_offers` (`id`, `product_id`, `normal_price`, `offer_rate`, `offer_price`, `month`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'PRODUCT-9LKT4G', 1000.00, 10.00, 900.00, '2025-05', 'active', '2025-05-05 05:40:21', '2025-05-05 05:40:21'),
	(2, 'PRODUCT-RJ2ROA', 2000.00, 5.00, 1900.00, '2025-05', 'active', '2025-05-07 10:53:10', '2025-05-07 10:53:10');

-- Dumping structure for table omc_db2.subcategories
CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `subcategory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.subcategories: ~2 rows (approximately)
REPLACE INTO `subcategories` (`id`, `category_id`, `subcategory`, `created_at`, `updated_at`) VALUES
	(3, 1, 'Phones', '2025-05-05 05:33:18', '2025-05-05 05:33:18'),
	(4, 1, 'Laptops', '2025-05-05 05:33:18', '2025-05-05 05:33:18');

-- Dumping structure for table omc_db2.sub_subcategories
CREATE TABLE IF NOT EXISTS `sub_subcategories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subcategory_id` bigint unsigned NOT NULL,
  `sub_subcategory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.sub_subcategories: ~4 rows (approximately)
REPLACE INTO `sub_subcategories` (`id`, `subcategory_id`, `sub_subcategory`, `created_at`, `updated_at`) VALUES
	(3, 3, 'LG 101', '2025-05-05 05:33:18', '2025-05-05 05:33:18'),
	(4, 3, 'LG A02', '2025-05-05 05:33:18', '2025-05-05 05:33:18'),
	(5, 4, 'Gaming', '2025-05-05 05:33:18', '2025-05-05 05:33:18'),
	(6, 4, 'Work', '2025-05-05 05:33:18', '2025-05-05 05:33:18');

-- Dumping structure for table omc_db2.system_users
CREATE TABLE IF NOT EXISTS `system_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `system_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.system_users: ~0 rows (approximately)
REPLACE INTO `system_users` (`id`, `name`, `email`, `contact`, `password`, `role`, `image_path`, `status`, `created_at`, `updated_at`) VALUES
	(1, '123', 'manulakavishka7@gmail.com', '0754555411', '$2y$12$n0Po0rPjl1yB6x9Zaz/Z7OcxcOp4weLOtDrhm5uVQ6l6NEOTxB.l.', 'admin', 'React.png', 1, '2025-05-02 11:27:56', '2025-05-08 22:28:12'),
	(2, 'Manula', 'manulakavishka@gmail.com', '0754555412', '$2y$12$FURnnjOAqj9Ao9Sv1OnpEuLH1ms50lXfNOq84SY7JJWx40a7/N5qK', 'admin', 'Next.png', 1, '2025-05-08 22:27:36', '2025-05-08 22:27:36');

-- Dumping structure for table omc_db2.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.users: ~3 rows (approximately)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `address`, `district`, `date_of_birth`, `gender`, `phone_num`, `acc_no`, `bank_name`, `branch`, `last_login`, `role`, `profile_image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Manula', 'manula@gmail.com', NULL, NULL, '123', '123', '2025-05-05', 'male', '123', '123', '123', '123', NULL, 'user', NULL, '1', NULL, NULL, NULL),
	(2, 'Manula', 'manulakavishka9@gmail.com', NULL, '$2y$12$H4Tb6/2XXbmezI7Taa5eC.x7FFJhM8ck1OD07tyrXKVIErAxQHp96', 'sd', '123', '2025-02-03', NULL, '0234234324', NULL, NULL, NULL, '2025-05-22 22:21:50', NULL, NULL, NULL, NULL, '2025-05-06 01:16:45', '2025-05-22 22:21:50'),
	(3, 'asd', 'manu@gmail.com', NULL, '$2y$12$jTpEGUejxHdKRhTI5BNYluigGD8pQaISrhiGlMdfWhLumlDWyYPCa', '123/ colombo1212', '123', '2025-05-19', NULL, '0234234324', NULL, NULL, NULL, '2025-05-20 00:10:25', NULL, NULL, NULL, NULL, '2025-05-20 00:10:12', '2025-05-20 00:10:25');

-- Dumping structure for table omc_db2.variations
CREATE TABLE IF NOT EXISTS `variations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hex_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `variations_product_id_foreign` (`product_id`),
  CONSTRAINT `variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.variations: ~3 rows (approximately)
REPLACE INTO `variations` (`id`, `product_id`, `type`, `value`, `hex_value`, `quantity`, `created_at`, `updated_at`) VALUES
	(26, 'PRODUCT-9LKT4G', 'Material', 'lather', NULL, 3, '2025-05-21 01:42:45', '2025-05-21 01:42:45'),
	(27, 'PRODUCT-9LKT4G', 'Size', 'Xl', NULL, 0, '2025-05-21 01:42:45', '2025-05-21 05:40:24'),
	(28, 'PRODUCT-9LKT4G', 'Color', 'Tall Poppy', '#c32828', 0, '2025-05-21 01:42:47', '2025-05-22 05:16:53');

-- Dumping structure for table omc_db2.wish_lists
CREATE TABLE IF NOT EXISTS `wish_lists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wish_lists_user_id_foreign` (`user_id`),
  KEY `wish_lists_product_id_foreign` (`product_id`),
  CONSTRAINT `wish_lists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  CONSTRAINT `wish_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table omc_db2.wish_lists: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
