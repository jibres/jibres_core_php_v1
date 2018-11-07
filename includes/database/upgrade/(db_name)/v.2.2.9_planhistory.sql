CREATE TABLE `planhistory` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`creator` int(10) UNSIGNED NULL,
`plan` varchar(100) NULL DEFAULT NULL,
`desc` text CHARACTER SET utf8mb4,
`start` datetime NULL,
`end` datetime NULL,
`status` enum('enable', 'disable', 'deleted') NULL DEFAULT NULL,
`price` int(10) UNSIGNED NULL,
`discount` int(10) UNSIGNED NULL,
`promo` varchar(100) NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `planhistory_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


UPDATE stores SET stores.plan = 'free', stores.datemodified = stores.datemodified, stores.startplan = stores.datecreated WHERE stores.plan is NULL;

INSERT INTO planhistory
(
	`store_id`,
	`creator`,
	`plan`,
	`start`,
	`end`,
	`status`
)
SELECT
stores.id,
stores.creator,
stores.plan,
stores.startplan,
null,
'enable'
FROM
stores
WHERE stores.id NOT IN (SELECT pH.store_id FROM planhistory AS `pH`);