ALTER TABLE `productterms` ADD `site` ENUM('yes','no') NOT NULL DEFAULT 'yes' AFTER `count`;
ALTER TABLE `productterms` ADD `valuetype` ENUM('decimal', 'integer') NULL DEFAULT NULL AFTER `site`;
ALTER TABLE `productterms` ADD `isdefault` bit(1) NULL DEFAULT NULL AFTER `valuetype`;
ALTER TABLE `productterms` ADD `file` varchar(1000) NULL DEFAULT NULL AFTER `isdefault`;
