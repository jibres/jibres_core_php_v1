ALTER TABLE jibres.store_domain ADD `master` bit(1) NULL DEFAULT NULL;
ALTER TABLE jibres.store_domain ADD KEY `store_domain_index_search_master` (`master`);

