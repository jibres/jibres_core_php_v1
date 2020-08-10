ALTER TABLE jibres_XXXXXXX.tax_coding ADD `class` varchar(200) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_coding ADD `topic` varchar(200) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_coding ADD KEY `tax_coding_search_index_class` (`class`);
ALTER TABLE jibres_XXXXXXX.tax_coding ADD KEY `tax_coding_search_index_topic` (`topic`);


ALTER TABLE jibres_XXXXXXX.tax_coding ADD `naturecontrol` BIT(1) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_coding ADD `exchangeable` BIT(1) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_coding ADD `followup` BIT(1) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_coding ADD `currency` BIT(1) NULL DEFAULT NULL;