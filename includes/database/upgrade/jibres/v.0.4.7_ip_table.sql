
CREATE DATABASE IF NOT EXISTS `jibres_visitor` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS jibres_visitor.ip (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`ipv4` varchar(100) DEFAULT NULL,
`ipv6` varchar(100) DEFAULT NULL,
`ipv4long` bigint(20) DEFAULT NULL,
`block` enum('block', 'unblock', 'unknown', 'new') NULL DEFAULT NULL,
`countblock` int(10)  NULL DEFAULT NULL,
`datecreated` datetime NULL DEFAULT NULL,
`datemodified` datetime NULL DEFAULT NULL,
PRIMARY KEY (`id`),
INDEX `search_index_ipv4` (`ipv4`),
INDEX `search_index_ipv6` (`ipv6`),
INDEX `search_index_ipv4long` (`ipv4long`),
INDEX `search_index_block` (`block`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
