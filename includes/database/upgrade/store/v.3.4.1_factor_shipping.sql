CREATE TABLE jibres_XXXXXXX.factorshipping (
`factor_id` bigint UNSIGNED NOT NULL,
`title` varchar(100) DEFAULT NULL,
`name` varchar(200) DEFAULT NULL,
`company` bit(1) DEFAULT NULL,
`companyname` varchar(100) DEFAULT NULL,
`jobtitle` varchar(100) DEFAULT NULL,
`country` char(2) DEFAULT NULL,
`province` varchar(6) DEFAULT NULL,
`city` varchar(100) DEFAULT NULL,
`address` varchar(500) DEFAULT NULL,
`address2` varchar(500) DEFAULT NULL,
`postcode` varchar(50) DEFAULT NULL,
`phone` varchar(50) DEFAULT NULL,
`mobile` varchar(20) DEFAULT NULL,
`fax` varchar(50) DEFAULT NULL,
`latitude` varchar(100) DEFAULT NULL,
`longitude` varchar(100) DEFAULT NULL,
`map` text,
`packagetype` enum('box', 'envelope', 'soft package', 'other') NULL DEFAULT NULL,
`packagename` varchar(200) NULL DEFAULT NULL,
`package_weight` DECIMAL(13, 4) NULL DEFAULT NULL,
`products_weight` DECIMAL(13, 4) NULL DEFAULT NULL,
`weight` DECIMAL(13, 4) NULL DEFAULT NULL,
`length` DECIMAL(13, 4) NULL DEFAULT NULL,
`width` DECIMAL(13, 4) NULL DEFAULT NULL,
`height` DECIMAL(13, 4) NULL DEFAULT NULL,
`shippingdate` timestamp NULL DEFAULT NULL,
`sendtype` varchar(200),
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`factor_id`),
CONSTRAINT `factorshipping_factor_id` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



ALTER TABLE jibres_XXXXXXX.factordetails ADD `weight` int(10) NULL DEFAULT NULL;


ALTER TABLE jibres_XXXXXXX.products CHANGE `width` `width` DECIMAL(13, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.products CHANGE `weight` `weight` DECIMAL(13, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.products CHANGE `length` `length` DECIMAL(13, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.products CHANGE `height` `height` DECIMAL(13, 4) NULL DEFAULT NULL;
