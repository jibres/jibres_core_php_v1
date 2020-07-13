INSERT INTO jibres_XXXXXXX.productcategoryusage
(`productcategory_id`,`product_id`)
SELECT products.cat_id, products.id FROM jibres_XXXXXXX.products WHERE products.cat_id IS NOT NULL;