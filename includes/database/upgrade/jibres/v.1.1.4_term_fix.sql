ALTER TABLE jibres.termusages DROP KEY `termusages_related_id`;
ALTER TABLE jibres.termusages DROP KEY `termusages_related`;
ALTER TABLE jibres.termusages DROP KEY `termusages_status`;
ALTER TABLE jibres.termusages DROP KEY `termusages_related_id_search_index`;
ALTER TABLE jibres.termusages DROP KEY `termusages_related_search_index`;
ALTER TABLE jibres.termusages DROP `status`;
ALTER TABLE jibres.termusages DROP `related`;

ALTER TABLE jibres.termusages CHANGE `related_id` `post_id` bigint UNSIGNED NOT NULL;
ALTER TABLE jibres.termusages CHANGE `type` `type` enum('cat','tag') DEFAULT NULL AFTER `post_id`;
ALTER TABLE jibres.termusages CHANGE `order` `sort` smallint NULL DEFAULT NULL;

ALTER TABLE jibres.termusages ADD COLUMN `id` BIGINT NOT NULL AUTO_INCREMENT UNIQUE FIRST;


ALTER TABLE jibres.termusages ADD KEY `termusages_index_post_id` (`post_id`);
ALTER TABLE jibres.termusages ADD KEY `termusages_index_term_id` (`term_id`);


ALTER TABLE jibres.terms DROP `caller`;
ALTER TABLE jibres.terms CHANGE `status` `status` enum('enable','disable','deleted') NULL DEFAULT 'enable';
