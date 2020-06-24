ALTER TABLE jibres_XXXXXXX.factors ADD `guestid` varchar(50) CHARACTER SET utf8mb4 NULL DEFAULT NULL;


CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.factoraddress (
  `factor_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `company` bit(1) DEFAULT NULL,
  `companyname` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `jobtitle` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `country` char(2) CHARACTER SET utf8mb4 DEFAULT NULL,
  `province` varchar(6) CHARACTER SET utf8mb4 DEFAULT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `address` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `address2` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `postcode` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `fax` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `latitude` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `longitude` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `map` text CHARACTER SET utf8mb4,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`factor_id`),
  CONSTRAINT `factoraddress_factor_id` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
