CREATE TABLE IF NOT EXISTS jibres.giftlookup (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`code` varchar(100)  NULL,
`gift_id` bigint(20) UNSIGNED NULL,
`valid` enum('yes', 'no')  NULL,
`errortype` varchar(100)  NULL,
`message` text  NULL,
`datecreated` timestamp  NULL,
`agent_id` int(10) UNSIGNED  NULL,
`ip_id` bigint(20) UNSIGNED  NULL,
PRIMARY KEY (`id`),
KEY `giftlookup_index_search_code` (`code`),
KEY `giftlookup_index_search_user_id` (`user_id`),
KEY `giftlookup_index_search_valid` (`valid`),
KEY `giftlookup_index_search_gift_id` (`gift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



