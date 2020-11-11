ALTER TABLE jibres_XXXXXXX.factors ADD `mode` ENUM('admin', 'customer', 'auto') DEFAULT NULL;
UPDATE jibres_XXXXXXX.factors SET `mode` = 'admin';
