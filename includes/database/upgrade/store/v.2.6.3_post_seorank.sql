ALTER TABLE jibres_XXXXXXX.posts ADD `seorank` smallint(3) NULL DEFAULT NULL AFTER `comment`;
ALTER TABLE jibres_XXXXXXX.posts ADD INDEX `posts_index_search_seorank` (`seorank`);