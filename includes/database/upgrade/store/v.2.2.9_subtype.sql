ALTER TABLE jibres_XXXXXXX.posts DROP `subtype`;
ALTER TABLE jibres_XXXXXXX.posts ADD `subtype` enum('standard', 'gallery','video','audio','help_center') NULL DEFAULT 'standard';
ALTER TABLE jibres_XXXXXXX.posts ADD INDEX `search_index_subtype` (`subtype`);
ALTER TABLE jibres_XXXXXXX.posts ADD `cover` varchar(500) NULL DEFAULT NULL AFTER `thumb`;
