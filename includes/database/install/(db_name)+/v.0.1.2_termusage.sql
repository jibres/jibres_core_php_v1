CREATE TABLE IF NOT EXISTS `termusages` (
  `term_id` int(10) UNSIGNED NOT NULL,
  `related_id` bigint(20) UNSIGNED NOT NULL,
  `related` enum('posts','products','attachments','files','comments','users','tickets') DEFAULT NULL,
  `order` smallint(5) UNSIGNED DEFAULT NULL,
  `status` enum('enable','disable','expired','awaiting','filtered','blocked','spam','violence','pornography','other','deleted') NOT NULL DEFAULT 'enable',
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `type` enum('cat','tag','term','code','other','support_tag','mag','mag_tag','help','help_tag','barcode1','barcode2','barcode3','qrcode1','qrcode2','qrcode3','rfid1','rfid2','rfid3','fingerprint1','fingerprint2','fingerprint3','fingerprint4','fingerprint5','fingerprint6','fingerprint7','fingerprint8','fingerprint9','fingerprint10') DEFAULT NULL,
  CONSTRAINT `termusage_term_id` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  KEY `related_id` (`related_id`),
  KEY `related` (`related`),
  KEY `status` (`status`),
  KEY `termusages_related_id_search_index` (`related_id`),
  KEY `termusages_related_search_index` (`related`),
  KEY `termusages_type_search_index` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




