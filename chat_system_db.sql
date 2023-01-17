/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.14-MariaDB : Database - chat_system
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`chat_system` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `chat_system`;

/*Table structure for table `chats` */

DROP TABLE IF EXISTS `chats`;

CREATE TABLE `chats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `chats` */

insert  into `chats`(`id`,`sender_id`,`receiver_id`,`created_at`,`updated_at`) values 
(2,4,5,'2023-01-09 17:15:10','2023-01-09 17:15:10'),
(3,4,7,'2023-01-09 17:33:22','2023-01-09 17:33:22'),
(4,4,6,'2023-01-09 17:58:20','2023-01-09 17:58:20'),
(5,4,9,'2023-01-14 18:08:20','2023-01-14 18:08:20'),
(6,4,4,'2023-01-14 18:08:27','2023-01-14 18:08:27'),
(7,9,5,'2023-01-17 17:56:34','2023-01-17 17:56:34'),
(8,9,6,'2023-01-17 17:56:36','2023-01-17 17:56:36'),
(9,9,7,'2023-01-17 17:56:37','2023-01-17 17:56:37'),
(10,12,5,'2023-01-17 17:58:24','2023-01-17 17:58:24'),
(11,12,6,'2023-01-17 17:58:25','2023-01-17 17:58:25'),
(12,12,9,'2023-01-17 17:58:26','2023-01-17 17:58:26'),
(13,12,10,'2023-01-17 17:58:28','2023-01-17 17:58:28'),
(14,12,4,'2023-01-17 17:58:57','2023-01-17 17:58:57'),
(15,13,9,'2023-01-17 18:04:14','2023-01-17 18:04:14'),
(16,13,6,'2023-01-17 18:04:20','2023-01-17 18:04:20'),
(17,13,10,'2023-01-17 19:22:30','2023-01-17 19:22:30'),
(18,13,4,'2023-01-17 19:22:33','2023-01-17 19:22:33');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) DEFAULT NULL,
  `message` varchar(250) DEFAULT NULL,
  `chat_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `messages` */

insert  into `messages`(`id`,`sender_id`,`message`,`chat_id`,`created_at`,`updated_at`) values 
(1,4,'hlo',2,'2023-01-09 17:15:30','2023-01-09 17:15:30'),
(2,4,'vipul kida',2,'2023-01-12 18:16:06','2023-01-12 18:16:06'),
(3,4,'Hiiii\r\ngth',2,'2023-01-12 18:16:40','2023-01-12 18:16:40'),
(4,12,'hlo',11,'2023-01-17 17:59:08','2023-01-17 17:59:08');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2023_01_04_064559_create_roles_table',2),
(6,'2023_01_04_071902_create_permissions_table',3),
(7,'2023_01_04_072652_create_modules_table',4);

/*Table structure for table `modules` */

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `modules` */

insert  into `modules`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'user','2023-01-04 07:41:59','2023-01-04 07:41:59'),
(2,'role','2023-01-04 07:42:06','2023-01-04 07:42:06'),
(3,'permission','2023-01-04 07:42:12','2023-01-04 07:42:12'),
(4,'module','2023-01-04 07:42:19','2023-01-04 07:42:19');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`email`,`token`,`created_at`) values 
('avinash.singh@theknowledgeacademy.com','$2y$10$DakW1k8Cl5ELa1B1U6ZImOyVEaGjZkth.8xopJZQxXqBYkW.vMJAq','2023-01-09 19:16:32'),
('taran@gmail.com','$2y$10$U0bwloYbMf3InGzogk89zOcjy1VjBETt7V77xkC0/egMuPPUojerq','2023-01-17 18:00:05');

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`module_id`,`created_at`,`updated_at`) values 
(1,'view',1,'2023-01-04 07:42:28','2023-01-04 07:42:28'),
(2,'create',1,'2023-01-04 07:42:37','2023-01-04 07:42:37'),
(3,'update',1,'2023-01-04 07:42:44','2023-01-04 07:42:44'),
(4,'delete',1,'2023-01-04 07:42:56','2023-01-04 07:42:56'),
(5,'view',2,'2023-01-04 07:43:19','2023-01-04 07:43:19'),
(6,'create',2,'2023-01-04 07:43:32','2023-01-04 07:43:32');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `role_permissions` */

DROP TABLE IF EXISTS `role_permissions`;

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `role_permissions` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`created_at`,`updated_at`) values 
(2,'role','2023-01-04 07:17:57','2023-01-04 07:17:57'),
(3,'permission','2023-01-04 07:18:04','2023-01-04 07:18:04'),
(4,'module','2023-01-04 07:18:10','2023-01-04 07:18:10');

/*Table structure for table `user_roles` */

DROP TABLE IF EXISTS `user_roles`;

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user_roles` */

insert  into `user_roles`(`id`,`user_id`,`role_id`) values 
(1,4,2),
(2,4,4);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) DEFAULT NULL,
  `is_admin` int(11) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`is_active`,`is_admin`,`last_login_at`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(4,'Avinash','avinash.singh@theknowledgeacademy.com',1,1,'2023-01-17 18:49:57',NULL,'$2y$10$.y2Mls.kZyEirlZY2yBFX.ns3EdkNrHLi9AZCjT6G2p8M5TseIs9G',NULL,'2023-01-04 07:05:19','2023-01-17 18:49:57'),
(5,'vipul','vipul@gmail.com',1,NULL,'2023-01-17 19:17:22',NULL,'$2y$10$UgCjnHTGAnrEEf4jZNNqeeF7K4w1aduNGkWlLdXYL2TYLoKw64zj.','EK6kUDcmjrqr6LVO1FE9F9f9z2szr8r4dNwb2DYHdlUszV50Y6aGop84muyB','2023-01-05 04:22:13','2023-01-17 19:17:22'),
(6,'soni kudi','soni@gmail.com',1,NULL,'2023-01-06 09:19:50',NULL,'$2y$10$TKfG5AxfIKjqEzVav9FUJe0568TnyQUyPJYaHCmM.em3jW181Dnyu',NULL,'2023-01-05 04:23:47','2023-01-06 09:19:50'),
(7,'archana','archana@gmail.com',1,NULL,'2023-01-06 09:23:39',NULL,'$2y$10$Llm1klhDhGGR8vookJ/G3usl0iBdTffm/bjnfnUqA5DMuFcgZBo2G',NULL,'2023-01-06 09:22:44','2023-01-06 09:23:39'),
(9,'konica','konica@gmail.com',1,NULL,'2023-01-17 18:29:56',NULL,'$2y$10$VGKK3S7n3nzPjdM2zDZHK.3jsueD22SYV3lGdc6GAz2cvfPGwgANq',NULL,'2023-01-14 18:05:42','2023-01-17 18:29:56'),
(10,'amanpreet','amanpreet@gmail.com',1,NULL,NULL,NULL,'$2y$10$aMhr2egfGsJxE7lHYLSgle2Vzz7tudvmqe0gvcw0beYyiaV1YrTem',NULL,'2023-01-14 19:07:16','2023-01-14 19:07:16'),
(13,'mehak','mehak@gmail.com',1,NULL,'2023-01-17 19:22:23',NULL,'$2y$10$6LRotV9fu1A30uAjOtgUIeLqo.FbXPusUtxmwVIeXLN1Lramri3KW','14XtPdm9sv7beG3IWdEaUdZqbxTVcCUCsq7uTYkSP37x2OAe6xAfY4vXv77T','2023-01-17 18:04:01','2023-01-17 19:22:23');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
