ALTER TABLE jibres.posts DROP `subtype`;
ALTER TABLE jibres.posts ADD `subtype` enum('standard', 'gallery','video','audio','help_center') NULL DEFAULT 'standard';
ALTER TABLE jibres.posts ADD INDEX `search_index_subtype` (`subtype`);


UPDATE jibres.posts SET posts.subtype = 'help_center', posts.type = 'post' WHERE posts.type = 'help';


ALTER TABLE jibres.posts ADD `cover` varchar(500) NULL DEFAULT NULL AFTER `thumb`;
