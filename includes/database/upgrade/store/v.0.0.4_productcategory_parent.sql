ALTER TABLE `jibres_XXXXXXX`.`productcategory` CHANGE `parent` `parent1` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `jibres_XXXXXXX`.`productcategory` ADD `parent2` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `parent1`;
ALTER TABLE `jibres_XXXXXXX`.`productcategory` ADD `parent3` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `parent2`;
ALTER TABLE `jibres_XXXXXXX`.`productcategory` ADD `parent4` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `parent3`;