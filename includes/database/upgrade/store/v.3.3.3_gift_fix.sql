DROP TABLE IF EXISTS jibres_XXXXXXX.giftusage;
DROP TABLE IF EXISTS jibres_XXXXXXX.giftlookup;
DROP TABLE IF EXISTS jibres_XXXXXXX.gift;


CREATE TABLE jibres_XXXXXXX.discount (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`code` varchar(100) DEFAULT NULL,
`type` enum('percentage','fixed_amount', 'free_shipping', 'buy_x_get_y', 'automatic') DEFAULT NULL,
`minrequirements` enum('none','amount', 'quantity') DEFAULT NULL,
`percentage` smallint UNSIGNED DEFAULT NULL,
`fixedamount` DECIMAL(22, 4) DEFAULT NULL,
`maxamount` DECIMAL(22, 4) DEFAULT NULL,
`minpurchase` DECIMAL(22, 4) DEFAULT NULL,
`minquantity` int(10) DEFAULT NULL,
`startdate`  timestamp NULL DEFAULT NULL,
`enddate` timestamp NULL DEFAULT NULL,
`applyto` enum('all_products','special_category', 'special_products') DEFAULT NULL,
`freeshipping` enum('all','special_country', 'special_province', 'special_city', 'other') DEFAULT NULL,
`customer` enum('everyone','special_customer_group', 'special_customer') DEFAULT NULL,

`creator` int UNSIGNED DEFAULT NULL,
`usagetotal` int UNSIGNED DEFAULT NULL,
`usageperuser` smallint UNSIGNED DEFAULT NULL,

`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
`datefirstuse` timestamp NULL DEFAULT NULL,
`datefinish` timestamp NULL DEFAULT NULL,
`status` enum('draft','enable','disable','deleted','expire','blocked') DEFAULT NULL,
`usagestatus` enum('used','full') DEFAULT NULL,
`desc` text,
`msgsuccess` text,
PRIMARY KEY (`id`),
KEY `discount_index_code` (`code`),
KEY `discount_index_status` (`status`),
KEY `discount_creator` (`creator`),
CONSTRAINT `discount_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



CREATE TABLE jibres_XXXXXXX.discount_dedicated (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`discount_id` bigint UNSIGNED DEFAULT NULL,
`type` enum(
	'special_products',
	'special_category',
	'special_customer_group',
	'special_customer',
	'special_country',
	'special_province',
	'special_city',
	'other') DEFAULT NULL,
`product_id` bigint UNSIGNED DEFAULT NULL,
`customer_id` bigint UNSIGNED DEFAULT NULL,
`product_category_id` bigint UNSIGNED DEFAULT NULL,
`specailvalue` varchar(200) DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `discount_dedicated_discount_id` FOREIGN KEY (`discount_id`) REFERENCES `discount` (`id`) ON UPDATE CASCADE,
KEY `discount_dedicated_index_type` (`type`),
KEY `discount_dedicated_index_product_id` (`product_id`),
KEY `discount_dedicated_index_customer_id` (`customer_id`),
KEY `discount_dedicated_index_product_category_id` (`product_category_id`),
KEY `discount_dedicated_index_specailvalue` (`specailvalue`),
KEY `discount_dedicated_index_discount_id` (`discount_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE jibres_XXXXXXX.discount_lookup (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`code` varchar(100) DEFAULT NULL,
`discount_id` bigint UNSIGNED DEFAULT NULL,
`user_id` int UNSIGNED DEFAULT NULL,
`valid` enum('yes','no') DEFAULT NULL,
`errortype` varchar(100) DEFAULT NULL,
`message` text,
`datecreated` timestamp NULL DEFAULT NULL,
`agent_id` int UNSIGNED DEFAULT NULL,
`ip_id` bigint UNSIGNED DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `discountlookup_index_code` (`code`),
KEY `discountlookup_index_user_id` (`user_id`),
KEY `discountlookup_index_valid` (`valid`),
KEY `discountlookup_index_discount_id` (`discount_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



CREATE TABLE jibres_XXXXXXX.discount_usage (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`discount_id` bigint UNSIGNED DEFAULT NULL,
`user_id` int UNSIGNED DEFAULT NULL,
`transaction_id` bigint UNSIGNED DEFAULT NULL,
`price` DECIMAL(22, 4) DEFAULT NULL,
`discount` DECIMAL(22, 4) DEFAULT NULL,
`discountpercent` smallint UNSIGNED DEFAULT NULL,
`finalprice` DECIMAL(22, 4) DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`ip_id` bigint UNSIGNED DEFAULT NULL,
`agent_id` int UNSIGNED DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `discountusage_user_id` (`user_id`),
KEY `discountusage_transaction_id` (`transaction_id`),
KEY `discountusage_discount_id` (`discount_id`),
KEY `discountusage_search_index_ip_id` (`ip_id`),
KEY `discountusage_search_index_agent_id` (`agent_id`),
CONSTRAINT `discountusage_discount_id` FOREIGN KEY (`discount_id`) REFERENCES `discount` (`id`) ON UPDATE CASCADE,
CONSTRAINT `discountusage_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON UPDATE CASCADE,
CONSTRAINT `discountusage_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



