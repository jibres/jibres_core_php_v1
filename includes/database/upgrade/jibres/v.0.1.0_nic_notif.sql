
CREATE TABLE IF NOT EXISTS jibres_nic.poll (
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


