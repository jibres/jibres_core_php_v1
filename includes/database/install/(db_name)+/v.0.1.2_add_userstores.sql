ALTER TABLE `contacts` ADD `store_id` INT(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `contacts` ADD CONSTRAINT `contacts_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;
