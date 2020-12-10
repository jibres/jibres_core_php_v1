ALTER TABLE jibres.posts ADD `gallery` TEXT NULL DEFAULT NULL AFTER `content`;
ALTER TABLE jibres.posts ADD `thumb` varchar(500) NULL DEFAULT NULL AFTER `content`;