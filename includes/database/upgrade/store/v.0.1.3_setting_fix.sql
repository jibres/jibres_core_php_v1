ALTER TABLE `jibres_XXXXXXX`.`setting` DROP CONSTRAINT `setting_user_id`;
ALTER TABLE `jibres_XXXXXXX`.`setting` DROP `user_id`;
ALTER TABLE `jibres_XXXXXXX`.`setting` DROP `json`;
ALTER TABLE `jibres_XXXXXXX`.`setting` CHANGE `value` `value` text CHARACTER SET utf8mb4 DEFAULT NULL;
ALTER TABLE `jibres_XXXXXXX`.`setting` ADD `platform` enum('androin', 'ios', 'telegram', 'website') DEFAULT NULL AFTER `id`;
ALTER TABLE `jibres_XXXXXXX`.`setting` ADD KEY `setting_index_search_platform` (`platform`);
