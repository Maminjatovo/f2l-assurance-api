-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour gestion_contrat
CREATE DATABASE IF NOT EXISTS `gestion_contrat` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `gestion_contrat`;

-- Listage de la structure de table gestion_contrat. contrats
CREATE TABLE IF NOT EXISTS `contrats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_date` date NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contrats_user_id_foreign` (`user_id`),
  CONSTRAINT `contrats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion_contrat.contrats : ~8 rows (environ)
INSERT INTO `contrats` (`id`, `title`, `creation_date`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'contrat mailo be', '2023-07-28', 4, '2024-03-10 17:33:55', '2024-03-12 11:37:14', NULL),
	(2, 'contrat 2', '2023-07-15', 4, '2024-03-10 17:34:39', '2024-03-12 11:09:16', NULL),
	(3, 'test', '2024-03-21', 4, '2024-03-12 12:05:30', '2024-03-12 12:09:14', NULL),
	(4, 'test1', '2024-03-28', 5, '2024-03-12 12:05:46', '2024-03-12 12:07:49', NULL),
	(5, 'gg', '2024-03-13', 5, '2024-03-12 12:09:34', '2024-03-12 12:09:34', NULL),
	(6, 'milou', '2024-03-22', 4, '2024-03-12 12:11:58', '2024-03-12 12:11:58', NULL),
	(7, 'Gafy', '2024-03-13', 7, '2024-03-12 19:10:36', '2024-03-12 19:10:36', NULL),
	(8, 'hahaha', '2024-03-07', 7, '2024-03-12 19:11:48', '2024-03-12 19:20:19', NULL),
	(9, 'aaa', '2024-03-01', 7, '2024-03-12 19:15:12', '2024-03-12 19:20:02', '2024-03-12 19:20:02'),
	(10, 'kkk', '2024-03-07', 7, '2024-03-12 19:19:37', '2024-03-12 19:20:30', '2024-03-12 19:20:30'),
	(11, 'bbbb', '2024-03-14', 6, '2024-03-13 19:11:48', '2024-03-13 19:12:13', '2024-03-13 19:12:13'),
	(12, 'contrat pret voiture', '2024-03-07', 11, '2024-03-15 16:08:36', '2024-03-15 16:08:36', NULL),
	(13, 'aa', '2024-03-01', 18, '2024-03-18 18:48:52', '2024-03-18 18:48:52', NULL),
	(14, 'tt', '2024-03-01', 17, '2024-03-18 19:42:49', '2024-03-18 19:42:49', NULL);

-- Listage de la structure de table gestion_contrat. documents
CREATE TABLE IF NOT EXISTS `documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrat_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_contrat_id_foreign` (`contrat_id`),
  CONSTRAINT `documents_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion_contrat.documents : ~20 rows (environ)
INSERT INTO `documents` (`id`, `titre`, `path`, `type`, `contrat_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(36, 'a', '4ktmNVSsjijmetZ8jrfLJBnI9UFItTN0XgOFeWzH.jpg', 'jpg', 13, '2024-03-18 19:45:38', '2024-03-18 19:45:38', NULL),
	(37, 'b', 'm75afnHaGkXJUjUhGX0oAFdSSJXLZjD2aLQpS55b.jpg', 'jpg', 14, '2024-03-18 19:46:52', '2024-03-18 19:46:52', NULL),
	(38, 'b', 'y9fxKsSxOGDbfWYT6Gx5jt83N5QsBTfSNBvJ7sTH.jpg', 'jpg', 13, '2024-03-18 19:47:23', '2024-03-18 19:47:23', NULL),
	(39, 'b', 'TtwbQPvyFBmvP0GFH6WTj7R3RmX1uT5WHur1t9w1.jpg', 'jpg', 13, '2024-03-18 19:47:25', '2024-03-18 19:47:25', NULL);

-- Listage de la structure de table gestion_contrat. failed_jobs
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

-- Listage des données de la table gestion_contrat.failed_jobs : ~0 rows (environ)

-- Listage de la structure de table gestion_contrat. messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion_contrat.messages : ~0 rows (environ)

-- Listage de la structure de table gestion_contrat. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion_contrat.migrations : ~8 rows (environ)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_03_07_114309_create_documents_table', 1),
	(6, '2024_03_07_114442_create_messages_table', 1),
	(7, '2024_03_07_153225_create_contrats_table', 2),
	(8, '2024_03_10_182026_create_documents_table', 3);

-- Listage de la structure de table gestion_contrat. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion_contrat.password_resets : ~0 rows (environ)

-- Listage de la structure de table gestion_contrat. personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion_contrat.personal_access_tokens : ~0 rows (environ)

-- Listage de la structure de table gestion_contrat. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_valid` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion_contrat.users : ~10 rows (environ)
INSERT INTO `users` (`id`, `first_name`, `last_name`, `registration_number`, `phone`, `email`, `is_valid`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `is_admin`) VALUES
	(4, 'princaka', 'princaka', '1111111111', '+2610344410934', 'princaka@gmail.com', 1, NULL, '$2y$10$.v/gaT/KrrVOI78m8K0TTOreymU.DueIJuVGEtq70QNQTpzr6Tthi', NULL, '2024-03-10 16:21:30', '2024-03-12 13:09:54', NULL, 1),
	(5, 'Andriantony', 'Manou', '2331097', '1111', 'manaka@gmail.com', 0, NULL, '$2y$10$fP61JEyabBWRUbAA71FUReNHbdDKSD6cwYVFb6oa0LgRLcMTn4inO', NULL, '2024-03-12 07:53:05', '2024-03-12 13:10:27', NULL, 1),
	(6, 'Kabone', 'Princy', '25514112', '03455261772', 'huhu@gmail.com', 0, NULL, '$2y$10$Nq0eLN6nNmJT853CSKaxq.JwSIYFL.NgQXAoO9gr7jGcv8St5QZmu', NULL, '2024-03-12 08:16:59', '2024-03-12 11:11:11', NULL, 1),
	(7, 'Na', 'ddede', '12122322', NULL, 'ma@gmail.com', 0, NULL, '$2y$10$aacFDWLvEx4wMUZQRSlGG.WhKW9w8DrU7kjRYFEDntZhFUPcZ0m6m', NULL, '2024-03-12 19:08:10', '2024-03-15 15:58:16', '2024-03-15 15:58:16', 1),
	(8, 'zkldhcj', 'crvr', '123313133', NULL, 'hahahaha@gmail.com', 1, NULL, '$2y$10$w.D12RIzb3fqr2TaZYkIceULcmk6ahRI9QOiFd3.ej5cvFOE79WDq', NULL, '2024-03-12 19:09:34', '2024-03-12 19:10:08', '2024-03-12 19:10:08', 1),
	(9, 'dad', 'wadawdawd', '46345', '023589899', 'dzdadw@gmail.com', 0, NULL, '$2y$10$vpJRheG73bk/DhZHDu.5uO3TgY3Y8jEhBCzXptkLrHZnIjjTSNs5C', NULL, '2024-03-13 19:10:31', '2024-03-13 19:11:31', '2024-03-13 19:11:31', 1),
	(10, 'manoa', 'hosea', '123456', '+2610344410934', 'manoa@gmail.com', 0, NULL, '$2y$10$xV0fzIphBsRzY6nSdg6ddeyGQQVo0rP/e/BogFxXO6is0PDtQ1hNy', NULL, '2024-03-15 05:31:59', '2024-03-15 05:31:59', NULL, 1),
	(11, 'rajaona', 'benoit', '123456', '+261348754160', 'rajaona@gmail.com', 1, NULL, '$2y$10$yMncLVZ5Ge3hpZPIQiCn6.7wgxJA2K3.FnzsgTlhkANt/DJHHGV6e', NULL, '2024-03-15 16:05:37', '2024-03-15 16:06:18', NULL, 0),
	(12, 'sahondra', 'raza', '123456', '+2610344410934', 'neny@gmail.com', 0, NULL, '$2y$10$P8sMsuJCArKgzKECQsoa8u0lnBvIfax9yCTD8so05yT.Rui0u2Kju', NULL, '2024-03-16 18:18:07', '2024-03-16 18:18:07', NULL, 1),
	(14, 'manoa', 'hosea', '123456', '+2610344410934', 'mama@gmail.com', 0, NULL, '$2y$10$vThI4pE.3N.NF6xZP0sPgunWMFIyZty9/omR21BDvNUcwexYdEl8a', NULL, '2024-03-16 18:55:23', '2024-03-16 18:55:23', NULL, 1),
	(17, 'test', 'testa', '123456', '+2613444109345', 'testa@gmail.com', 0, NULL, '$2y$10$ZIcoopR7rzODK/n8YqTX.O8m/Tn1pbhn1ghG91eBIWvRRvCJffaH6', NULL, '2024-03-17 18:04:39', '2024-03-17 18:04:39', NULL, 0),
	(18, 'princaka', 'princaka', '12345', '+261344410938', 'kkk@gmail.com', 0, NULL, '$2y$10$v.PIjZIbCY6c1XwxWMliE.ttJZb8cKH/tbcoNa94lGKQPSf.fpowa', NULL, '2024-03-18 06:27:52', '2024-03-18 06:27:52', NULL, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
