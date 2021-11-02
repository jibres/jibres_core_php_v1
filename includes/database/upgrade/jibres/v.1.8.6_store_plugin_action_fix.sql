ALTER TABLE jibres.store_plugin ADD `datestart` TIMESTAMP NULL DEFAULT NULL AFTER `datemodified`;
ALTER TABLE jibres.store_plugin_action ADD `desc` text NULL DEFAULT NULL;