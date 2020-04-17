CREATE TABLE IF NOT EXISTS jibres.gift (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`giftpercent` smallint(5) UNSIGNED NULL,
`giftamount` bigint(20) UNSIGNED NULL,
`giftmax` bigint(20) UNSIGNED NULL,
`pricefloor` bigint(20) UNSIGNED NULL,
`desc` text NULL DEFAULT NULL,
`creator` int(10) UNSIGNED NULL,
`usagetotal` int(10) UNSIGNED NULL,
`usageperuser` smallint(5) UNSIGNED NULL,
`code` varchar(100) NULL DEFAULT NULL,
`category` varchar(100) NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`dateexpire` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
`datefirstuse` timestamp NULL DEFAULT NULL,
`datefinish` timestamp NULL DEFAULT NULL,
`status` enum('draft', 'enable', 'disable', 'deleted', 'expire', 'blocked') NULL DEFAULT NULL,
`usagestatus` enum('used', 'full') NULL DEFAULT NULL,
`forusein` enum('any', 'domain', 'store', 'sms', 'ipg') NULL DEFAULT NULL,
`emailto` text NULL DEFAULT NULL,
`emailtemplate` varchar(100) NULL DEFAULT NULL,
`msgsuccess` text NULL DEFAULT NULL,
`forfirstorder` bit(1) NULL DEFAULT NULL,
`dedicated` text NULL DEFAULT NULL,
`physical` bit(1) NULL,
`chap` bit(1) NULL,
PRIMARY KEY (`id`),
KEY `gift_index_search_code` (`code`),
KEY `gift_index_search_status` (`status`),
CONSTRAINT `gift_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres.giftusage (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`gift_id` bigint(20) UNSIGNED NULL,
`user_id` int(10) UNSIGNED NULL,
`transaction_id` bigint(20) UNSIGNED NULL,
`price` bigint(20) UNSIGNED NULL,
`discount` bigint(20) UNSIGNED NULL,
`discountpercent` smallint(5) UNSIGNED NULL,
`finalprice` bigint(20) UNSIGNED NULL,
`datecreated` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `giftusage_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `giftusage_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON UPDATE CASCADE,
CONSTRAINT `giftusage_gift_id` FOREIGN KEY (`gift_id`) REFERENCES `gift` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
