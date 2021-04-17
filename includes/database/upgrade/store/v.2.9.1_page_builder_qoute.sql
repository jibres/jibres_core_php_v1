ALTER TABLE jibres_XXXXXXX.comments CHANGE `for` `for` ENUM('page','post','product','quote') CHARACTER SET utf8mb4  NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.comments  ADD `pagebuilder_id` int NULL DEFAULT NULL AFTER `factor_id`;
ALTER TABLE jibres_XXXXXXX.comments  ADD INDEX `index_search_pagebuilder_id` (`pagebuilder_id`);