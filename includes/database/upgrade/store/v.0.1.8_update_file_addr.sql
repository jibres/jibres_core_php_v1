UPDATE `jibres_XXXXXXX`.`tickets` SET `jibres_XXXXXXX`.`tickets`.`file`                   = REPLACE(`jibres_XXXXXXX`.`tickets`.`file`, 'files/', '');
UPDATE `jibres_XXXXXXX`.`setting` SET `jibres_XXXXXXX`.`setting`.`value`                   = REPLACE(`jibres_XXXXXXX`.`setting`.`value`, 'https://jibres.com/files/', '');
UPDATE `jibres_XXXXXXX`.`setting` SET `jibres_XXXXXXX`.`setting`.`value`                   = REPLACE(`jibres_XXXXXXX`.`setting`.`value`, 'https://jibres.ir/files/', '');

