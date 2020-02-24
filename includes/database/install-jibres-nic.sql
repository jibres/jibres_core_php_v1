
CREATE DATABASE IF NOT EXISTS `jibres_nic_log` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `jibres_nic_log`;

CREATE TABLE IF NOT EXISTS `log` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`type` enum(
	'whois',
	'contact_check',
	'contact_info',
	'contact_create',
	'contact_update',
	'domain_check',
	'domain_lock',
	'domain_unlock',
	'domain_info',
	'domain_create',
	'domain_update',
	'domain_renew',
	'domain_delete',
	'domain_transfer',
	'poll_request',
	'poll_acknowledge'
	) DEFAULT NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_index_search_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE DATABASE IF NOT EXISTS `jibres_nic` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `jibres_nic`;


CREATE TABLE IF NOT EXISTS `contact` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,

`user_id` int(10) UNSIGNED NULL,

`nic_id` varchar(30) NULL DEFAULT NULL,
`roid` varchar(50) NULL DEFAULT NULL,
`title` varchar(100) NULL DEFAULT NULL,

`holder` bit(1) NULL DEFAULT NULL,
`admin` bit(1) NULL DEFAULT NULL,
`tech` bit(1) NULL DEFAULT NULL,
`bill` bit(1) NULL DEFAULT NULL,


`isdefault` bit(1) NULL DEFAULT NULL,

`firstname` varchar(100) NULL DEFAULT NULL,
`lastname` varchar(100) NULL DEFAULT NULL,

`firstname_en` varchar(100) NULL DEFAULT NULL,
`lastname_en` varchar(100) NULL DEFAULT NULL,

`nationalcode` varchar(20) NULL DEFAULT NULL,
`passportcode` varchar(50) NULL DEFAULT NULL,

`company` varchar(200) NULL DEFAULT NULL,
`category` varchar(200) NULL DEFAULT NULL,

`email` varchar(200) NULL DEFAULT NULL,
`country` varchar(20) NULL DEFAULT NULL,
`province` varchar(50) NULL DEFAULT NULL,
`city` varchar(100) NULL DEFAULT NULL,
`postcode` varchar(20) NULL DEFAULT NULL,
`address` varchar(200) NULL DEFAULT NULL,
`mobile` varchar(20) NULL DEFAULT NULL,
`signator` varchar(200) NULL DEFAULT NULL,

`status` enum('enable', 'disable', 'deleted') NULL DEFAULT NULL,

`jsonstatus` text NULL DEFAULT NULL,

`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `contact_index_search_nic_id` (`nic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `dns` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,

`user_id` int(10) UNSIGNED NULL,

`title` varchar(200) NULL DEFAULT NULL,

`ns1` varchar(100) NULL DEFAULT NULL,
`ip1` varchar(100) NULL DEFAULT NULL,

`ns2` varchar(100) NULL DEFAULT NULL,
`ip2` varchar(100) NULL DEFAULT NULL,

`ns3` varchar(100) NULL DEFAULT NULL,
`ip3` varchar(100) NULL DEFAULT NULL,

`ns4` varchar(100) NULL DEFAULT NULL,
`ip4` varchar(100) NULL DEFAULT NULL,

`isdefault` bit(1) NULL DEFAULT NULL,

`status` enum('enable', 'disable', 'deleted', 'expire') NULL DEFAULT NULL,

`datecreated` timestamp NULL DEFAULT NULL,

PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE IF NOT EXISTS `domain` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,

`user_id` int(10) UNSIGNED NULL,

`registrar` enum('irnic') NULL DEFAULT NULL,
`name` varchar(200) NULL DEFAULT NULL,

`status` enum('awaiting','failed','pending','enable', 'disable', 'deleted', 'expire') NULL DEFAULT NULL,

`holder` varchar(30) NULL DEFAULT NULL,
`admin` varchar(30) NULL DEFAULT NULL,
`tech` varchar(30) NULL DEFAULT NULL,
`bill` varchar(30) NULL DEFAULT NULL,

`result` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,

`autorenew` bit(1) NULL DEFAULT NULL,

`lock` bit(1) NULL DEFAULT NULL,

`dns` int(10) UNSIGNED NULL DEFAULT NULL,


`dateregister` timestamp NULL DEFAULT NULL,
`dateexpire` timestamp NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,

PRIMARY KEY (`id`),
KEY `domain_index_search_name` (`name`),
KEY `domain_index_search_user_id` (`user_id`),
KEY `domain_index_search_dns` (`dns`),
CONSTRAINT `domain_dns` FOREIGN KEY (`dns`) REFERENCES `dns` (`id`) ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE IF NOT EXISTS `domain_action` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,

`domain_id` int(10) UNSIGNED NULL,
`user_id` int(10) UNSIGNED NULL,

`status` enum('enable', 'disable', 'deleted', 'expire') NULL DEFAULT NULL,
`action` enum('buy', 'renew', 'transfer', 'openlock', 'lock') NULL DEFAULT NULL,
`meta` text NULL DEFAULT NULL,
`date` timestamp NULL DEFAULT NULL,

`datecreated` timestamp NULL DEFAULT NULL,

PRIMARY KEY (`id`),
CONSTRAINT `domain_action_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE IF NOT EXISTS `domain_billing` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,

`domain_id` int(10) UNSIGNED NULL,
`user_id` int(10) UNSIGNED NULL,

`action` enum('buy', 'renew', 'transfer') NULL DEFAULT NULL,
`mode` enum('auto', 'manual') NULL DEFAULT NULL,

`price` int(10) UNSIGNED NULL DEFAULT NULL,
`discount` int(10) UNSIGNED NULL DEFAULT NULL,
`discountcode` int(10) UNSIGNED NULL DEFAULT NULL,
`finalprice` int(10) UNSIGNED NULL DEFAULT NULL,

`transaction_id` int(10) UNSIGNED NULL DEFAULT NULL,

`date` timestamp NULL DEFAULT NULL,

PRIMARY KEY (`id`),
CONSTRAINT `domain_billing_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




