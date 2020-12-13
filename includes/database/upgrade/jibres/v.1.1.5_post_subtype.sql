ALTER TABLE jibres.posts DROP `subtype`;
ALTER TABLE jibres.posts ADD `subtype` enum('standard', 'gallery','video','audio') NULL DEFAULT 'standard';
ALTER TABLE jibres.posts ADD INDEX `search_index_subtype` (`subtype`);

ALTER TABLE jibres.posts ADD `cover` varchar(500) NULL DEFAULT NULL AFTER `thumb`;
