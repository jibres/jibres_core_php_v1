ALTER TABLE `stores` ADD `permission` text CHARACTER  SET utf8mb4 NULL DEFAULT NULL;
ALTER TABLE `stores` ADD `expireplan` datetime  NULL DEFAULT NULL;

UPDATE userstores SET userstores.permission = 'admin' WHERE userstores.user_id IN (SELECT stores.creator FROM stores);



CREATE TABLE `jibres_log`.`agents` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`agent` text NOT NULL,
`group` varchar(50) DEFAULT NULL,
`name` varchar(50) DEFAULT NULL,
`version` varchar(50) DEFAULT NULL,
`os` varchar(50) DEFAULT NULL,
`osnum` varchar(50) DEFAULT NULL,
`robot` bit(1) DEFAULT NULL,
`meta` text,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `jibres_log`.`services` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`name` varchar(50) NOT NULL,
`subdomain` varchar(50)  NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `jibres_log`.`urls` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `domain` varchar(500) DEFAULT NULL,
  `url` text NOT NULL,
  `host` varchar(200) DEFAULT NULL,
  `query` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `jibres_log`.`visitors` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`service_id` int(10) UNSIGNED DEFAULT NULL,
`visitor_ip` int(10) UNSIGNED NULL,
`url_id` bigint(20) UNSIGNED NOT NULL,
`url_idreferer` bigint(20) UNSIGNED DEFAULT NULL,
`agent_id` int(10) UNSIGNED NOT NULL,
`user_id` int(10) UNSIGNED DEFAULT NULL,
`user_idteam` bigint(20) UNSIGNED DEFAULT NULL,
`external` bit(1) DEFAULT NULL,
`date` date NOT NULL,
`time` time NOT NULL,
`timeraw` int(10) UNSIGNED NULL DEFAULT NULL,
`year` int(4) DEFAULT NULL,
`month` int(2) DEFAULT NULL,
`day` int(2) DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `visitorip_index` (`visitor_ip`) USING BTREE,
KEY `url_id` (`url_id`),
KEY `visitors_urls_referer` (`url_idreferer`),
KEY `visitors_agents` (`agent_id`),
KEY `visitors_services` (`service_id`),
KEY `visitor_date` (`date`),
KEY `visitor_timeraw` (`timeraw`),
KEY `year` (`year`),
KEY `month` (`month`),
KEY `day` (`day`),
CONSTRAINT `visitors_agents` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON UPDATE CASCADE,
CONSTRAINT `visitors_services` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON UPDATE CASCADE,
CONSTRAINT `visitors_urls` FOREIGN KEY (`url_id`) REFERENCES `urls` (`id`) ON UPDATE CASCADE,
CONSTRAINT `visitors_urls_referer` FOREIGN KEY (`url_idreferer`) REFERENCES `urls` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `jibres_log`.`urls` ADD `urlmd5` varchar(32) DEFAULT NULL;
ALTER TABLE `jibres_log`.`urls` ADD `pwd` text DEFAULT NULL;
