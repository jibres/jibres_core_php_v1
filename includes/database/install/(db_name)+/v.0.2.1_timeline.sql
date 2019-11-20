CREATE TABLE IF NOT EXISTS `store_timeline` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NULL,

`login` datetime NULL,
`login_diff` int(10) UNSIGNED NULL,

`start` datetime NULL,
`start_diff` int(10) UNSIGNED NULL,

`ask` datetime NULL,
`ask_diff` int(10) UNSIGNED NULL,

`subdomain` datetime NULL,
`subdomain_diff` int(10) UNSIGNED NULL,

`creating` datetime NULL,
`creating_diff` int(10) UNSIGNED NULL,

`startcreate` datetime NULL,
`startcreate_diff` int(10) UNSIGNED NULL,

`endcreate` datetime NULL,
`endcreate_diff` int(10) UNSIGNED NULL,

`opening` datetime NULL,
`opening_diff` int(10) UNSIGNED NULL,

`loadstore` datetime NULL,
`loadstore_diff` int(10) UNSIGNED NULL,

`users` datetime NULL,
`productcompany` datetime NULL,
`productunit` datetime NULL,
`products` datetime NULL,
`factors` datetime NULL,
`factordetails` datetime NULL,
`funds` datetime NULL,
`inventory` datetime NULL,
`productcategory` datetime NULL,
`productcomment` datetime NULL,
`productprices` datetime NULL,
`productproperties` datetime NULL,
`producttag` datetime NULL,
`producttagusage` datetime NULL,
`files` datetime NULL,
`fileusage` datetime NULL,
`agents` datetime NULL,
`apilog` datetime NULL,

PRIMARY KEY (`id`),
CONSTRAINT `store_timeline_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
