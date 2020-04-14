
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
