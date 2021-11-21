CREATE TABLE jibres_XXXXXXX.social_posts (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`social` varchar(50) DEFAULT NULL,
`post_id` bigint UNSIGNED DEFAULT NULL,
`product_id` int UNSIGNED DEFAULT NULL,
`request` varchar(50) DEFAULT NULL,
`status` varchar(50) DEFAULT NULL,
`channel` varchar(100) DEFAULT NULL,
`messageid` varchar(100) DEFAULT NULL,
`data` mediumtext DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
`jibresrequestid` varchar(100) DEFAULT NULL,
PRIMARY KEY (`id`),
INDEX `social_posts_index_social` (`social`),
INDEX `social_posts_index_status` (`status`),
INDEX `social_posts_index_messageid` (`messageid`),
INDEX `social_posts_index_request` (`request`),
CONSTRAINT `social_posts_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON UPDATE CASCADE,
CONSTRAINT `social_posts_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

