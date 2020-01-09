SET sql_mode = 'NO_UNSIGNED_SUBTRACTION';
UPDATE  `jibres_XXXXXXX`.`productprices` SET productprices.price = productprices.compareatprice;
UPDATE  `jibres_XXXXXXX`.`productprices` SET productprices.finalprice = productprices.price - productprices.discount;