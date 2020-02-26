
UPDATE `jibres`.`files` SET `jibres`.`files`.`folder` = REPLACE(`jibres`.`files`.`folder`, 'files/', '');
UPDATE `jibres`.`files` SET `jibres`.`files`.`path` = REPLACE(`jibres`.`files`.`path`, 'files/', '');
UPDATE `jibres`.`users` SET `jibres`.`users`.`avatar` = REPLACE(`jibres`.`users`.`avatar`, 'files/', '');

