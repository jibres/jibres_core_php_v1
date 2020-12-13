ALTER TABLE jibres.posts DROP `subtype`;
ALTER TABLE jibres.posts ADD `subtype` enum('standard', 'gallery','video','audio','help_center') NULL DEFAULT 'standard';
ALTER TABLE jibres.posts ADD INDEX `search_index_subtype` (`subtype`);