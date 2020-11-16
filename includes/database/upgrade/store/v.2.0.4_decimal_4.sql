ALTER TABLE jibres_XXXXXXX.cart ADD `count2` DECIMAL(20, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.cart ADD `price2` DECIMAL(20, 4) NULL DEFAULT NULL;



UPDATE jibres_XXXXXXX.cart SET cart.count2      = (CAST(cart.count AS DECIMAL(20, 4)) / 1000) WHERE cart.count IS NOT NULL;
UPDATE jibres_XXXXXXX.cart SET cart.price2        = (CAST(cart.price AS DECIMAL(20, 4)) / 100) WHERE cart.price IS NOT NULL;


ALTER TABLE jibres_XXXXXXX.cart DROP `count`;
ALTER TABLE jibres_XXXXXXX.cart DROP `price`;



ALTER TABLE jibres_XXXXXXX.cart CHANGE `count2` `count` DECIMAL(20, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.cart CHANGE `price2` `price` DECIMAL(20, 4) NULL DEFAULT NULL;
