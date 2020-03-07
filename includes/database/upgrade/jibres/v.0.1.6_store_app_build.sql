ALTER TABLE `jibres`.`store_app` ADD `build`  int(10) unsigned   NULL DEFAULT NULL AFTER `version`;
ALTER TABLE `jibres`.`store_app` ADD `meta`  text   NULL DEFAULT NULL AFTER `file`;