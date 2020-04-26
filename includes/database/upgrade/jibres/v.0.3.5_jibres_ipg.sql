
CREATE DATABASE IF NOT EXISTS `jibres_ipg` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `jibres_ipg`;


CREATE TABLE IF NOT EXISTS `userdetail` (
`user_id` int(10) UNSIGNED NOT NULL,
`gender` enum('male', 'female', 'company') NULL DEFAULT NULL,
`firstname` varchar(100) NULL DEFAULT NULL,
`lastname` varchar(100) NULL DEFAULT NULL,
`father` varchar(100) NULL DEFAULT NULL,
`birthday` date NULL DEFAULT NULL,
`firstname_en` varchar(100) NULL DEFAULT NULL,
`lastname_en` varchar(100) NULL DEFAULT NULL,
`father_en` varchar(100) NULL DEFAULT NULL,
`nationality` varchar(20) NULL DEFAULT NULL,
`passport` varchar(20) NULL DEFAULT NULL,
`passportexpire` varchar(20) NULL DEFAULT NULL,
`passportpic` varchar(20) NULL DEFAULT NULL,
`nationalcode` varchar(20) NULL DEFAULT NULL,
`nationalpic` varchar(20) NULL DEFAULT NULL,
`shpic` varchar(20) NULL DEFAULT NULL,
`verifypic` varchar(20) NULL DEFAULT NULL,
`postcode` varchar(20) NULL DEFAULT NULL,

`company` enum('yes', 'no') NULL DEFAULT NULL,
`companyname` varchar(200) NULL DEFAULT NULL,
`companyregisternumber` varchar(200) NULL DEFAULT NULL,
`companynationalid` varchar(200) NULL DEFAULT NULL,
`companyeconomiccode` varchar(200) NULL DEFAULT NULL,
`ceonationalcode` varchar(200) NULL DEFAULT NULL,

`status` enum('active', 'pending', 'deactive') NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`user_id`),
KEY `userdetail_index_search_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `iban` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NOT NULL,

`title` varchar(100) NULL DEFAULT NULL,
`shaba` varchar(100) NULL DEFAULT NULL,
`card` varchar(100) NULL DEFAULT NULL,
`hesab` varchar(100) NULL DEFAULT NULL,
`bank` varchar(100) NULL DEFAULT NULL,
`expireyear` varchar(100) NULL DEFAULT NULL,
`expiremonth` varchar(100) NULL DEFAULT NULL,
`isdefault` bit(1) NULL DEFAULT NULL,

`status` enum('enable', 'expire', 'pending', 'deleted') NULL DEFAULT NULL,

`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `iban_index_search_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `gateway` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NOT NULL,
`wallet_id` int(10) UNSIGNED NOT NULL,
`apikey` varchar(100) NULL DEFAULT NULL,

`title` varchar(100) NULL DEFAULT NULL,
`website` varchar(100) NULL DEFAULT NULL,
`websiteurl` varchar(100) NULL DEFAULT NULL,
`email` varchar(200) NULL DEFAULT NULL,
`phone` varchar(20) NULL DEFAULT NULL,
`logo` varchar(20) NULL DEFAULT NULL,

`status` enum('enable', 'disable', 'deleted', 'lock', 'reject', 'pending', 'blocked') NULL DEFAULT NULL,

`category` varchar(200) NULL DEFAULT NULL,

`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `gateway_index_search_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `wallet` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NOT NULL,
`title` varchar(100) NULL DEFAULT NULL,
`color` varchar(100) NULL DEFAULT NULL,
`status` enum('enable', 'disable', 'deleted') NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `wallet_index_search_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
