DROP TABLE IF EXISTS jibres.store_premium;
DROP TABLE IF EXISTS jibres.store_plugin;


CREATE TABLE jibres.store_plugin (
`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` INT UNSIGNED NOT NULL,
`plugin` VARCHAR(150) NULL DEFAULT NULL,
`zone` VARCHAR(50) NULL DEFAULT NULL,
`status` ENUM('pending', 'enable', 'disable', 'deleted', 'expired', 'cancel') NULL DEFAULT NULL,
`datecreated` TIMESTAMP NULL DEFAULT NULL,
`datemodified` TIMESTAMP NULL DEFAULT NULL,
`expiredate` TIMESTAMP NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `index_search_store_plugin_datecreated` (`datecreated`),
KEY `index_search_store_plugin_expiredate` (`expiredate`),
KEY `index_search_store_plugin_store_id` (`store_id`),
KEY `index_search_store_plugin_plugin` (`plugin`),
KEY `index_search_store_plugin_status` (`status`),
KEY `index_search_store_plugin_zone` (`zone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE jibres.store_plugin_action (
`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
`plugin_id` BIGINT UNSIGNED NOT NULL,
`status` ENUM('pending', 'enable', 'disable', 'deleted', 'expired', 'cancel', 'refund', 'failed') NULL DEFAULT NULL,
`addedby` ENUM('user', 'admin', 'system') NULL DEFAULT NULL,
`type` ENUM('activate', 'cancel', 'refund', 'delete', 'renew') NULL DEFAULT NULL,
`parent` BIGINT UNSIGNED NULL,
`user_id` INT UNSIGNED NULL DEFAULT NULL,
`price` DECIMAL(22,4) NULL DEFAULT NULL,
`discount` DECIMAL(22,4) NULL DEFAULT NULL,
`finalprice` DECIMAL(22,4) NULL DEFAULT NULL,
`transaction_id` BIGINT UNSIGNED NULL,
`giftusage_id` BIGINT UNSIGNED NULL,
`datecreated` TIMESTAMP NULL DEFAULT NULL,
`datemodified` TIMESTAMP NULL DEFAULT NULL,
`datestart` TIMESTAMP NULL DEFAULT NULL,
`plusday` INT NULL DEFAULT NULL,
`expiredate` TIMESTAMP NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `plugin_action_plugin_id` FOREIGN KEY (`plugin_id`) REFERENCES `store_plugin` (`id`) ON UPDATE CASCADE,
KEY `index_search_store_plugin_action_datecreated` (`datecreated`),
KEY `index_search_store_plugin_action_finalprice` (`finalprice`),
KEY `index_search_store_plugin_action_expiredate` (`expiredate`),
KEY `index_search_store_plugin_action_addedby` (`addedby`),
KEY `index_search_store_plugin_action_plusday` (`plusday`),
KEY `index_search_store_plugin_action_status` (`status`),
KEY `index_search_store_plugin_action_price` (`price`),
KEY `index_search_store_plugin_action_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;