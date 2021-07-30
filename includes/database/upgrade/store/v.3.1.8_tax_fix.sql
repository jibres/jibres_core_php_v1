ALTER TABLE jibres_XXXXXXX.tax_document CHANGE `status` `status` ENUM('draft','lock','temp','deleted','archive') CHARACTER SET utf8mb4  NULL DEFAULT NULL;
