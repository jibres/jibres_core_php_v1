ALTER TABLE jibres_XXXXXXX.productcategory ADD `parent5` INT NULL DEFAULT NULL AFTER `parent4`;
ALTER TABLE jibres_XXXXXXX.productcategory ADD `firstlevel` bit(1) NULL DEFAULT NULL AFTER `showonwebsite`;

ALTER TABLE jibres_XXXXXXX.productcategory ADD INDEX `productcategory_search_index_title` (`title`);
ALTER TABLE jibres_XXXXXXX.productcategory ADD INDEX `productcategory_search_index_parent1` (`parent1`);
ALTER TABLE jibres_XXXXXXX.productcategory ADD INDEX `productcategory_search_index_parent2` (`parent2`);
ALTER TABLE jibres_XXXXXXX.productcategory ADD INDEX `productcategory_search_index_parent3` (`parent3`);
ALTER TABLE jibres_XXXXXXX.productcategory ADD INDEX `productcategory_search_index_parent4` (`parent4`);
ALTER TABLE jibres_XXXXXXX.productcategory ADD INDEX `productcategory_search_index_parent5` (`parent5`);
ALTER TABLE jibres_XXXXXXX.productcategory ADD INDEX `productcategory_search_index_firstlevel` (`firstlevel`);