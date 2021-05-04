ALTER TABLE jibres_XXXXXXX.pagebuilder DROP `platform`;

ALTER TABLE jibres_XXXXXXX.pagebuilder ADD `device` ENUM('all','desktop', 'mobile', 'other') CHARACTER SET utf8mb4  NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.pagebuilder ADD `mobile` ENUM('all','browser','pwa', 'application','other') CHARACTER SET utf8mb4  NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.pagebuilder ADD `os` ENUM('all','windows','linux', 'mac', 'android', 'other') CHARACTER SET utf8mb4  NULL DEFAULT NULL;

ALTER TABLE jibres_XXXXXXX.pagebuilder  ADD INDEX `index_search_device` (`device`);
ALTER TABLE jibres_XXXXXXX.pagebuilder  ADD INDEX `index_search_mobile` (`mobile`);
ALTER TABLE jibres_XXXXXXX.pagebuilder  ADD INDEX `index_search_os` (`os`);
