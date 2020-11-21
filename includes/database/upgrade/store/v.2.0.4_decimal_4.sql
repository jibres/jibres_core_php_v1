ALTER TABLE jibres_XXXXXXX.cart ADD `count2` DECIMAL(13, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.cart ADD `price2` DECIMAL(22, 4) NULL DEFAULT NULL;

UPDATE jibres_XXXXXXX.cart SET cart.count2 = CAST((cart.count / 1000) AS DECIMAL(13, 4)) WHERE cart.count IS NOT NULL;
UPDATE jibres_XXXXXXX.cart SET cart.price2 = CAST((cart.price / 100) AS DECIMAL(22, 4)) WHERE cart.price IS NOT NULL;

ALTER TABLE jibres_XXXXXXX.cart DROP `count`;
ALTER TABLE jibres_XXXXXXX.cart DROP `price`;

ALTER TABLE jibres_XXXXXXX.cart CHANGE `count2` `count` DECIMAL(13, 4) NULL DEFAULT NULL AFTER `product_id`;
ALTER TABLE jibres_XXXXXXX.cart CHANGE `price2` `price` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `product_id`;
