ALTER TABLE jibres_XXXXXXX.products DROP FOREIGN KEY `products_field_company_id`;
ALTER TABLE jibres_XXXXXXX.products DROP `company_id`;
ALTER TABLE jibres_XXXXXXX.dayevent DROP `productcompany`;
DROP TABLE jibres_XXXXXXX.productcompany;
