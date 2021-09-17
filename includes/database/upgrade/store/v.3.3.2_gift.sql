CREATE TABLE jibres_XXXXXXX.gift (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`giftpercent` smallint UNSIGNED DEFAULT NULL,
`giftamount` bigint UNSIGNED DEFAULT NULL,
`giftmax` bigint UNSIGNED DEFAULT NULL,
`pricefloor` bigint UNSIGNED DEFAULT NULL,
`desc` text,
`creator` int UNSIGNED DEFAULT NULL,
`usagetotal` int UNSIGNED DEFAULT NULL,
`usageperuser` smallint UNSIGNED DEFAULT NULL,
`code` varchar(100) DEFAULT NULL,
`category` varchar(100) DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`dateexpire` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
`datefirstuse` timestamp NULL DEFAULT NULL,
`datefinish` timestamp NULL DEFAULT NULL,
`status` enum('draft','enable','disable','deleted','expire','blocked') DEFAULT NULL,
`usagestatus` enum('used','full') DEFAULT NULL,
`forusein` varchar(100) DEFAULT NULL,
`msgsuccess` text,
`forfirstorder` bit(1) DEFAULT NULL,
`dedicated` text,
PRIMARY KEY (`id`),
KEY `gift_index_search_code` (`code`),
KEY `gift_index_search_status` (`status`),
KEY `gift_creator` (`creator`),
CONSTRAINT `gift_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE jibres_XXXXXXX.giftlookup (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int UNSIGNED DEFAULT NULL,
`code` varchar(100) DEFAULT NULL,
`gift_id` bigint UNSIGNED DEFAULT NULL,
`valid` enum('yes','no') DEFAULT NULL,
`errortype` varchar(100) DEFAULT NULL,
`message` text,
`datecreated` timestamp NULL DEFAULT NULL,
`agent_id` int UNSIGNED DEFAULT NULL,
`ip_id` bigint UNSIGNED DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `giftlookup_index_search_code` (`code`),
KEY `giftlookup_index_search_user_id` (`user_id`),
KEY `giftlookup_index_search_valid` (`valid`),
KEY `giftlookup_index_search_gift_id` (`gift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



CREATE TABLE jibres_XXXXXXX.giftusage (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`gift_id` bigint UNSIGNED DEFAULT NULL,
`user_id` int UNSIGNED DEFAULT NULL,
`transaction_id` bigint UNSIGNED DEFAULT NULL,
`price` bigint UNSIGNED DEFAULT NULL,
`discount` bigint UNSIGNED DEFAULT NULL,
`discountpercent` smallint UNSIGNED DEFAULT NULL,
`finalprice` bigint UNSIGNED DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`ip_id` bigint UNSIGNED DEFAULT NULL,
`agent_id` int UNSIGNED DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `giftusage_user_id` (`user_id`),
KEY `giftusage_transaction_id` (`transaction_id`),
KEY `giftusage_gift_id` (`gift_id`),
KEY `giftusage_search_index_ip_id` (`ip_id`),
KEY `giftusage_search_index_agent_id` (`agent_id`),
CONSTRAINT `giftusage_gift_id` FOREIGN KEY (`gift_id`) REFERENCES `gift` (`id`) ON UPDATE CASCADE,
CONSTRAINT `giftusage_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON UPDATE CASCADE,
CONSTRAINT `giftusage_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

