ALTER TABLE jibres_XXXXXXX.telegrams ADD `post_id` bigint(20) UNSIGNED NULL DEFAULT NULL AFTER `user_id`;
ALTER TABLE jibres_XXXXXXX.telegrams ADD `product_id` int(10) UNSIGNED NULL DEFAULT NULL AFTER `post_id`;
ALTER TABLE jibres_XXXXXXX.telegrams ADD `message_id` bigint NULL DEFAULT NULL AFTER `product_id`;
ALTER TABLE jibres_XXXXXXX.telegrams ADD `username` varchar(100) NULL DEFAULT NULL AFTER `message_id`;


ALTER TABLE jibres_XXXXXXX.telegrams ADD INDEX `telegrams_search_index_chatid` (`chatid`);
ALTER TABLE jibres_XXXXXXX.telegrams ADD INDEX `telegrams_search_index_user_id` (`user_id`);
ALTER TABLE jibres_XXXXXXX.telegrams ADD INDEX `telegrams_search_index_post_id` (`post_id`);
ALTER TABLE jibres_XXXXXXX.telegrams ADD INDEX `telegrams_search_index_product_id` (`product_id`);
ALTER TABLE jibres_XXXXXXX.telegrams ADD INDEX `telegrams_search_index_message_id` (`message_id`);
ALTER TABLE jibres_XXXXXXX.telegrams ADD INDEX `telegrams_search_index_username` (`username`);
ALTER TABLE jibres_XXXXXXX.telegrams ADD INDEX `telegrams_search_index_status` (`status`);
ALTER TABLE jibres_XXXXXXX.telegrams ADD INDEX `telegrams_search_index_senddate` (`senddate`);

