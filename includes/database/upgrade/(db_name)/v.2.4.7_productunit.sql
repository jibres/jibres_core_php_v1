CREATE TABLE `productunit` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`title` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`desimal` bit(1) NULL DEFAULT NULL,
`isdefault` bit(1) NULL DEFAULT NULL,
`maxsale` int(10) UNSIGNED NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `productunit_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
