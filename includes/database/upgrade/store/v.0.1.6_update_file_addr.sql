
UPDATE `jibres_XXXXXXX`.`files` SET `jibres_XXXXXXX`.`files`.`folder`                   = REPLACE(`jibres_XXXXXXX`.`files`.`folder`, 'files/', '');
UPDATE `jibres_XXXXXXX`.`files` SET `jibres_XXXXXXX`.`files`.`path`                     = REPLACE(`jibres_XXXXXXX`.`files`.`path`, 'files/', '');

UPDATE `jibres_XXXXXXX`.`products` SET `jibres_XXXXXXX`.`products`.`gallery`            = REPLACE(`jibres_XXXXXXX`.`products`.`gallery`, 'files/', '');
UPDATE `jibres_XXXXXXX`.`products` SET `jibres_XXXXXXX`.`products`.`thumb`              = REPLACE(`jibres_XXXXXXX`.`products`.`thumb`, 'files/', '');
UPDATE `jibres_XXXXXXX`.`productcategory` SET `jibres_XXXXXXX`.`productcategory`.`file` = REPLACE(`jibres_XXXXXXX`.`productcategory`.`file`, 'files/', '');
UPDATE `jibres_XXXXXXX`.`users` SET `jibres_XXXXXXX`.`users`.`avatar`                   = REPLACE(`jibres_XXXXXXX`.`users`.`avatar`, 'files/', '');

