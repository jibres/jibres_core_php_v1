
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
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_index_search_type` (`type`),
KEY `log_index_search_user_id` (`user_id`),
KEY `log_index_search_datesend` (`datesend`),
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

`lastfetch` timestamp  NULL DEFAULT NULL,
`dateupdate` timestamp  NULL DEFAULT NULL,
`nicstatus` text  NULL DEFAULT NULL,
`reseller` varchar(100)  NULL DEFAULT NULL,
`roid` varchar(100)  NULL DEFAULT NULL,
`verify` bit(1) NULL DEFAULT NULL,

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





CREATE TABLE IF NOT EXISTS `domainaction` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,

`domain_id` int(10) UNSIGNED NULL,
`user_id` int(10) UNSIGNED NULL,

`status` enum('enable', 'disable', 'deleted', 'expire') NULL DEFAULT NULL,
`action` enum('register', 'renew', 'transfer', 'unlock', 'lock', 'changedns', 'updateholder', 'delete', 'expire') NULL DEFAULT NULL,
`mode` enum('auto', 'manual') NULL DEFAULT NULL,

`detail` text NULL DEFAULT NULL,

`date` timestamp NULL DEFAULT NULL,

`price` int(10) UNSIGNED NULL DEFAULT NULL,
`discount` int(10) UNSIGNED NULL DEFAULT NULL,

`transaction_id` int(10) UNSIGNED NULL DEFAULT NULL,

`datecreated` timestamp NULL DEFAULT NULL,

PRIMARY KEY (`id`),
CONSTRAINT `domainaction_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE IF NOT EXISTS `poll` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`server_id` varchar(50)  NULL,
`domain` varchar(100)  NULL,
`nic_id` varchar(50)  NULL,
`notif_count` int(10) UNSIGNED  NULL,
`index` varchar(500)  NULL,
`note` varchar(500)  NULL,
`detail` text NULL DEFAULT NULL,
`read` bit(1) NULL DEFAULT NULL,
`acknowledge` bit(1) NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;








CREATE TABLE IF NOT EXISTS jibres_nic_log.domains (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`domain` varchar(300) DEFAULT NULL,
`root` varchar(300) DEFAULT NULL,
`tld` varchar(300) DEFAULT NULL,
`domainlen` smallint(5) DEFAULT NULL,
`registrar` varchar(200) NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`dateregister` timestamp NULL DEFAULT NULL,
`dateexpire` timestamp NULL DEFAULT NULL,
`dateupdate` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
`ns1` varchar(200) NULL DEFAULT NULL,
`ns2` varchar(200) NULL DEFAULT NULL,
`ns3` varchar(200) NULL DEFAULT NULL,
`ns4` varchar(200) NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `domains_index_search_domain` (`domain`),
KEY `domains_index_search_root` (`root`),
KEY `domains_index_search_tld` (`tld`),
KEY `domains_index_search_datecreated` (`datecreated`),
KEY `domains_index_search_dateexpire` (`dateexpire`),
KEY `domains_index_search_domainlen` (`domainlen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE IF NOT EXISTS jibres_nic_log.domainactivity (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`domain_id` bigint(20) UNSIGNED DEFAULT NULL,
`user_id` int(10) UNSIGNED DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`type` varchar(200) NULL DEFAULT NULL,
`available` bit(1) NULL DEFAULT NULL,
`ip` varchar(100) NULL DEFAULT NULL,
`result` text NULL DEFAULT NULL,
`runtime` text NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `domainactivity_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`) ON UPDATE CASCADE,
KEY `domainactivity_index_search_type` (`type`),
KEY `domainactivity_index_search_available` (`available`),
KEY `domainactivity_index_search_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE jibres_nic_log.log ADD `domain` VARCHAR(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.log ADD KEY `log_index_search_domain` (`domain`);
ALTER TABLE jibres_nic_log.log ADD KEY `log_index_search_nic_id` (`nic_id`);



ALTER TABLE jibres_nic_log.log ADD `ip` VARCHAR(50) NULL DEFAULT NULL;


CREATE TABLE IF NOT EXISTS jibres_nic.domainbilling (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`domain_id` int(10) UNSIGNED NULL,
`user_id` int(10) UNSIGNED NULL,
`action` enum('register', 'renew', 'transfer', 'delete') NULL DEFAULT NULL,
`status` enum('enable', 'disable', 'deleted', 'expire') NULL DEFAULT NULL,
`mode` enum('auto', 'manual') NULL DEFAULT NULL,
`detail` text NULL DEFAULT NULL,
`date` timestamp NULL DEFAULT NULL,
`period` smallint(3) UNSIGNED NULL DEFAULT NULL,
`price` int(10) UNSIGNED NULL DEFAULT NULL,
`discount` int(10) UNSIGNED NULL DEFAULT NULL,
`transaction_id` int(10) UNSIGNED NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `domainbilling_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE jibres_nic.domainaction ADD `category` VARCHAR(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domainaction ADD `period` smallint(3) NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domainaction ADD `domainname` VARCHAR(300) NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domainaction CHANGE `action` `action` VARCHAR(200) NULL DEFAULT NULL;



INSERT INTO jibres_nic.domainbilling
(`id`,
`domain_id`,
`user_id`,
`action`,
`status`,
`mode`,
`detail`,
`date`,
`price`,
`discount`,
`transaction_id`,
`datecreated`)
SELECT
jibres_nic.domainaction.id,
jibres_nic.domainaction.domain_id,
jibres_nic.domainaction.user_id,
jibres_nic.domainaction.action,
jibres_nic.domainaction.status,
jibres_nic.domainaction.mode,
jibres_nic.domainaction.detail,
jibres_nic.domainaction.date,
jibres_nic.domainaction.price,
jibres_nic.domainaction.discount,
jibres_nic.domainaction.transaction_id,
jibres_nic.domainaction.datecreated
FROM
jibres_nic.domainaction
WHERE jibres_nic.domainaction.transaction_id IS NOT NULL;




ALTER TABLE jibres_nic_log.domainactivity ADD `holder` varchar(30) NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domainactivity ADD `admin` varchar(30) NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domainactivity ADD `tech` varchar(30) NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domainactivity ADD `bill` varchar(30) NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domainactivity ADD `nicstatus` text  NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domainactivity ADD `reseller` varchar(100)  NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domainactivity ADD `roid` varchar(100)  NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domainactivity ADD `dateregister` timestamp NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domainactivity ADD `dateexpire` timestamp NULL DEFAULT NULL;


ALTER TABLE jibres_nic_log.domainactivity ADD `ns1` varchar(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domainactivity ADD `ns2` varchar(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domainactivity ADD `ns3` varchar(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domainactivity ADD `ns4` varchar(200) NULL DEFAULT NULL;



ALTER TABLE jibres_nic_log.domains ADD `holder` varchar(30) NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domains ADD `admin` varchar(30) NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domains ADD `tech` varchar(30) NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domains ADD `bill` varchar(30) NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domains ADD `nicstatus` text  NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domains ADD `reseller` varchar(100)  NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.domains ADD `roid` varchar(100)  NULL DEFAULT NULL;





ALTER TABLE jibres_nic.domain ADD `ns1` varchar(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domain ADD `ns2` varchar(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domain ADD `ns3` varchar(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domain ADD `ns4` varchar(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domain ADD `ip1` varchar(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domain ADD `ip2` varchar(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domain ADD `ip3` varchar(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domain ADD `ip4` varchar(200) NULL DEFAULT NULL;






CREATE TABLE IF NOT EXISTS jibres_nic.usersetting (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,

`autorenewperiod` varchar(100) NULL DEFAULT NULL,
`domainlifetime` varchar(100) NULL DEFAULT NULL,


`notifsms` bit(1) NULL DEFAULT NULL,
`notifemail` bit(1) NULL DEFAULT NULL,

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

`ns1` varchar(200) NULL DEFAULT NULL,
`ns2` varchar(200) NULL DEFAULT NULL,
`ns3` varchar(200) NULL DEFAULT NULL,
`ns4` varchar(200) NULL DEFAULT NULL,

`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `usersetting_index_search_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE jibres_nic.domainbilling ADD `finalprice` bigint(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domainbilling ADD `giftusage_id` bigint(20) UNSIGNED NULL DEFAULT NULL;


ALTER TABLE jibres_nic.domainaction ADD `finalprice` bigint(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domainaction ADD `giftusage_id` bigint(20) UNSIGNED NULL DEFAULT NULL;



CREATE TABLE IF NOT EXISTS jibres_nic.domainstatus (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`domain` varchar(300) NULL DEFAULT NULL,
`status` varchar(100) NULL DEFAULT NULL,
`active` bit(1) NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `domainstatus_domain` (`domain`),
KEY `domainstatus_status` (`status`),
KEY `domainstatus_active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE jibres_nic.domain ADD `available` bit(1) NULL DEFAULT NULL;


CREATE TABLE IF NOT EXISTS jibres_nic.contactdetail (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`nic_id` varchar(300) NULL DEFAULT NULL,
`person` varchar(500) NULL DEFAULT NULL,
`email` varchar(500) NULL DEFAULT NULL,
`address` text NULL DEFAULT NULL,
`phone` varchar(300) NULL DEFAULT NULL,
`mobile` varchar(15) NULL DEFAULT NULL,
`fax` varchar(300) NULL DEFAULT NULL,
`org` varchar(500) NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `contactdetail_nic_id` (`nic_id`),
KEY `contactdetail_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



ALTER TABLE jibres_nic.domain ADD KEY `domain_search_index_verify` (`verify`);
ALTER TABLE jibres_nic.domain ADD KEY `domain_search_index_available` (`available`);
ALTER TABLE jibres_nic.domain ADD KEY `domain_search_index_autorenew` (`autorenew`);

ALTER TABLE jibres_nic_log.domains ADD KEY `domains_search_index_registrar` (`registrar`);
ALTER TABLE jibres_nic_log.domainactivity ADD KEY `domainactivity_search_index_available` (`available`);
ALTER TABLE jibres_nic_log.domainactivity ADD KEY `domainactivity_search_index_type` (`type`);
