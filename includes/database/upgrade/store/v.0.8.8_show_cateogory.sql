ALTER TABLE jibres_XXXXXXX.productcategory ADD `showonwebsite` bit(1) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productcategory ADD KEY `productcategory_search_index_showonwebsite` (`showonwebsite`);
UPDATE jibres_XXXXXXX.productcategory SET jibres_XXXXXXX.productcategory.showonwebsite  = 1 where 1;