ALTER TABLE jibres_XXXXXXX.productcategory ADD `sort` int(10) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productcategory ADD KEY `productcategory_search_index_sort` (`sort`);