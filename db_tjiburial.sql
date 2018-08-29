/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.30-MariaDB : Database - db_tjiburial
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_tjiburial` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_tjiburial`;

/*Table structure for table `blog_images` */

DROP TABLE IF EXISTS `blog_images`;

CREATE TABLE `blog_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `blog_images` */

/*Table structure for table `blogs` */

DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `blogs` */

insert  into `blogs`(`id`,`title`,`description`,`created_at`,`updated_at`) values (1,'Blog B','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aperiam, architecto assumenda distinctio dolore eaque exercitationem fuga harum impedit maxime nesciunt nisi, perspiciatis quaerat quam quisquam reprehenderit sed unde voluptatum?</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aperiam, architecto assumenda distinctio dolore eaque exercitationem fuga harum impedit maxime nesciunt nisi, perspiciatis quaerat quam quisquam reprehenderit sed unde voluptatum?<br></p>','2018-08-03 03:58:23','2018-08-03 04:00:52');

/*Table structure for table `bookings` */

DROP TABLE IF EXISTS `bookings`;

CREATE TABLE `bookings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `bookings` */

insert  into `bookings`(`id`,`reservation_id`,`title`,`name`,`email`,`dob`,`nationality`,`country`,`state`,`city`,`address`,`phone_code`,`phone_no`,`created_at`,`updated_at`) values (1,1,'Mr.','Rina Sulaeman','ariqdaffaathallah@gmail.com','2000-05-06','Indonesia','Indonesia','Jawa Barat','Kota Bandung','Jl. Yupiter Utama Dalam\r\nBlok D2 No.2','+358','082333232323','2018-08-16 15:03:30','2018-08-16 15:03:30'),(2,2,'Ms.','Joni Akbarinda','ariqdaffaathallah@gmail.com','1992-03-04','Indonesia','Indonesia','Jawa Barat','Kota Bandung','Jl. Yupiter Utama Dalam\r\nBlok D2 No.2','+57','82116772822','2018-08-28 14:09:06','2018-08-28 14:09:06'),(3,3,'Mr.','Joko Sujoko','hamayat123@gmail.com','1990-08-04','Indonesia','Indonesia','Jawa Barat','Kota Bandung','Jl. Yupiter Utama Dalam\r\nBlok D2 No.2','+62','82116771533','2018-08-29 06:58:03','2018-08-29 06:58:03');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_07_25_093113_create_rooms_table',2),(4,'2018_07_25_095527_create_room_photos_table',3),(5,'2018_07_31_042609_alter_room_photos_table_add_main',4),(8,'2018_08_01_140659_create_promotions_table',5),(9,'2018_08_01_140850_create_promotion_images_table',5),(11,'2018_08_01_155851_alter_promotions_table_add_status',6),(14,'2018_08_02_131117_create_blogs_table',7),(15,'2018_08_03_004413_create_blog_images_table',7),(16,'2018_08_07_133530_alter_rooms_table_add_slug',8),(17,'2018_08_13_090000_alter_rooms_table',9),(20,'2018_08_14_135833_create_bookings_table',10),(21,'2018_08_15_125700_create_reservations_table',10),(22,'2018_08_28_140616_alter_reservations_table_add_payment_type',11);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `promotion_images` */

DROP TABLE IF EXISTS `promotion_images`;

CREATE TABLE `promotion_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `promotion_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `promotion_images` */

insert  into `promotion_images`(`id`,`promotion_id`,`image`,`main`,`created_at`,`updated_at`) values (5,4,'Promotion A-05-08-2018--1533452367.jpg',1,'2018-08-05 06:59:28','2018-08-05 06:59:28'),(6,5,'Promotion B-05-08-2018--1533452512.png',1,'2018-08-05 07:01:52','2018-08-05 07:01:52');

/*Table structure for table `promotions` */

DROP TABLE IF EXISTS `promotions`;

CREATE TABLE `promotions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `promotions` */

insert  into `promotions`(`id`,`title`,`description`,`status`,`created_at`,`updated_at`) values (4,'Promotion A','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aperiam, architecto assumenda distinctio dolore eaque exercitationem fuga harum impedit maxime nesciunt nisi, perspiciatis quaerat quam quisquam reprehenderit sed unde voluptatum?<br></p>',0,'2018-08-03 03:53:56','2018-08-03 03:53:56'),(5,'Promotion B','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aperiam at cupiditate eaque eos facilis fugiat id laborum magnam minus porro, praesentium quaerat quasi quisquam repudiandae saepe sapiente voluptas voluptatum!</p><div><br></div>',0,'2018-08-05 07:00:00','2018-08-05 07:00:00');

/*Table structure for table `reservations` */

DROP TABLE IF EXISTS `reservations`;

CREATE TABLE `reservations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `duration` int(11) NOT NULL,
  `check_out` date NOT NULL,
  `room_count` int(11) NOT NULL,
  `guest_count` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `reservations` */

insert  into `reservations`(`id`,`room_id`,`user_id`,`check_in`,`duration`,`check_out`,`room_count`,`guest_count`,`total`,`status`,`payment_type`,`created_at`,`updated_at`) values (1,2,2,'2018-08-16',1,'2018-08-17',1,'1 Guest',300000,0,'Bank Transfer','2018-08-16 15:03:30','2018-08-16 15:03:30'),(2,3,2,'2018-08-28',3,'2018-08-31',1,'1 Guest',1050000,1,'Credit Card','2018-08-28 14:09:06','2018-08-28 14:09:06'),(3,3,2,'2018-08-29',1,'2018-08-30',1,'1 Guest',350000,2,'At Check In','2018-08-29 06:58:03','2018-08-29 06:58:03');

/*Table structure for table `room_photos` */

DROP TABLE IF EXISTS `room_photos`;

CREATE TABLE `room_photos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `room_photos` */

insert  into `room_photos`(`id`,`room_id`,`image`,`main`,`created_at`,`updated_at`) values (1,2,'Room X-31-07-2018--1533011113.jpg',1,'2018-07-31 04:25:13','2018-07-31 04:25:13'),(12,3,'Regular Room-07-08-2018--1533652812.JPG',1,'2018-08-07 14:40:12','2018-08-07 14:40:12'),(13,3,'Regular Room-07-08-2018--1533653035.JPG',0,'2018-08-07 14:43:55','2018-08-07 14:43:55'),(15,4,'Room Damar 1-13-08-2018--1534164597.png',1,'2018-08-13 12:49:57','2018-08-13 12:49:57');

/*Table structure for table `rooms` */

DROP TABLE IF EXISTS `rooms`;

CREATE TABLE `rooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `price_weekend` int(11) NOT NULL,
  `overview` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `facilities` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amenities` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `specials` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_guest` int(11) NOT NULL,
  `installment` int(11) NOT NULL DEFAULT '0',
  `featured` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rooms` */

insert  into `rooms`(`id`,`name`,`slug`,`type`,`price`,`price_weekend`,`overview`,`facilities`,`amenities`,`specials`,`max_guest`,`installment`,`featured`,`created_at`,`updated_at`) values (2,'Room X','room-x','Ulin',300000,450000,'<p>fgsgsgs</p>','<p>sdfsdgfqeg</p>','<p>sdgsgs</p>','<p>sdgsegqe</p>',10,1,1,'2018-07-30 15:35:27','2018-08-13 12:45:51'),(3,'Regular Room','regular-room','Albasiah',350000,400000,'<p>dfgadfgadfg</p>','<p>dfgadfgadfg</p>','<p>adfgadfgda</p>','<p>dfgafgadf</p>',4,1,0,'2018-08-07 13:47:58','2018-08-13 12:44:37');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`type`,`remember_token`,`created_at`,`updated_at`) values (1,'Admin','admin@tjiburial.com','$2y$10$v4qpxveo8lFnaPIQzQcHru2xGAyKvnyxFSOFoSoT8XRaPDubXi4ra','admin','QYQGBTSVzFR13rVzBBbFnTqNpDIZg7AJjUF2m5rhpbb4lMRIjGJAuyA5MAGN','2018-06-29 07:27:49','2018-06-29 07:27:49'),(2,'Ariq Daffa','ariqdaffaathallah@gmail.com','$2y$10$ThB5XOkcDSoeIrTLJiJz4ukEUL/OsSLw1zqg2/2JimuJj2b6gZwUu','default','msGz6R6ot8wBhYgbDua5ve0W4yaRjqgvIGCVdg1zvRPZaN5tUBULBhfMcKMV','2018-07-19 05:42:14','2018-07-19 05:42:14');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
