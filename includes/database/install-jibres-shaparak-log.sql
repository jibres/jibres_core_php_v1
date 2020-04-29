CREATE DATABASE IF NOT EXISTS `jibres_shaparak_log` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `jibres_shaparak_log`;


CREATE TABLE IF NOT EXISTS jibres_shaparak_log.request (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`					int(10) unsigned DEFAULT NULL,
`trackingNumber`			varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`trackingNumberPsp`			varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`requestRejectionReasons`	mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`success`					varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`datecreated`				timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified`				timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`sendmd5`					char(32) NULL DEFAULT NULL,
`responsemd5`				char(32) NULL DEFAULT NULL,
`send`						mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`response`					mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`url`						text CHARACTER SET utf8mb4 DEFAULT NULL,
`sendtime`					int(10) unsigned NULL DEFAULT NULL,
`responsetime`				int(10) unsigned NULL DEFAULT NULL,
`diff`						int(10) unsigned NULL DEFAULT NULL,
`related`					varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`related_id`				bigint(20) NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS jibres_shaparak_log.check (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`					int(10) unsigned DEFAULT NULL,
`request_id`				bigint(20) unsigned  NULL,
`related` 					varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`related_id`				bigint(20) NULL,
`sendmd5`					char(32) NULL DEFAULT NULL,
`responsemd5`				char(32) NULL DEFAULT NULL,
`trackingNumber` 			varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`trackingNumberPsp` 		varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`requestDate` 				varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`description` 				varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`requestType` 				varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`merchant` 					mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`relatedMerchants` 			varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`requestRejectionReasons` 	mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`requestDetails` 			mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`status` 					varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`send`						mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`response`					mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`url`						text CHARACTER SET utf8mb4 DEFAULT NULL,
`datecreated`				timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified`				timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`sendtime`					int(10) unsigned NULL DEFAULT NULL,
`responsetime`				int(10) unsigned NULL DEFAULT NULL,
`diff`						int(10) unsigned NULL DEFAULT NULL,
CONSTRAINT `check_request_id` FOREIGN KEY (`request_id`) REFERENCES `request` (`id`) ON UPDATE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


