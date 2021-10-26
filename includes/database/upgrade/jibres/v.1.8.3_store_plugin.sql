DROP TABLE IF EXISTS jibres.store_features;

CREATE TABLE jibres.store_plugin (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` INT(10) UNSIGNED NOT NULL,

`plugin` varchar(150) NULL DEFAULT NULL,
`zone` varchar(50) NULL DEFAULT NULL,

`status` ENUM('pending', 'cancel', 'failed','enable', 'disable', 'deleted', 'expire') NULL DEFAULT NULL,
`addedby` ENUM('user', 'admin', 'system') NULL DEFAULT NULL,
`description` varchar(200) NULL DEFAULT NULL,

`user_id` INT(10) UNSIGNED NULL DEFAULT NULL,

`price` DECIMAL(22,4) NULL DEFAULT NULL,
`discount` DECIMAL(22,4) NULL DEFAULT NULL,
`finalprice` DECIMAL(22,4) NULL DEFAULT NULL,
`transaction_id` bigint(20) UNSIGNED NULL,
`giftusage_id` bigint(20) UNSIGNED NULL,

`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
`datestart` timestamp NULL DEFAULT NULL,
`dateexpire` timestamp NULL DEFAULT NULL,

PRIMARY KEY (`id`),
KEY `index_search_store_plugin_datecreated` (`datecreated`),
KEY `index_search_store_plugin_plugin` (`plugin`),
KEY `index_search_store_plugin_dateexpire` (`dateexpire`),
KEY `index_search_store_plugin_store_id` (`store_id`),
KEY `index_search_store_plugin_price` (`price`),
KEY `index_search_store_plugin_finalprice` (`finalprice`),
KEY `index_search_store_plugin_status` (`status`),
KEY `index_search_store_plugin_addedby` (`addedby`),
KEY `index_search_store_plugin_zone` (`zone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;