
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
