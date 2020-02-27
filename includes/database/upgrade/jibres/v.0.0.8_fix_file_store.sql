UPDATE `jibres`.`store_data` SET `jibres`.`store_data`.`logo` = REPLACE(`jibres`.`store_data`.`logo`, 'https://jibres.com/files/', '');
UPDATE `jibres`.`store_data` SET `jibres`.`store_data`.`logo` = REPLACE(`jibres`.`store_data`.`logo`, 'https://jibres.ir/files/', '');
UPDATE `jibres`.`store_data` SET `jibres`.`store_data`.`logo` = REPLACE(`jibres`.`store_data`.`logo`, 'files/', '');

UPDATE `jibres`.`tickets` SET `jibres`.`tickets`.`file` = REPLACE(`jibres`.`tickets`.`file`, 'files/', '');

