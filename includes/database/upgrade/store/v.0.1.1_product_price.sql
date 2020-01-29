ALTER TABLE `jibres_XXXXXXX`.`products` ADD `buyprice` bigint(20) UNSIGNED DEFAULT NULL AFTER `slug`;
ALTER TABLE `jibres_XXXXXXX`.`products` ADD `price` bigint(20) UNSIGNED DEFAULT NULL AFTER `slug`;
ALTER TABLE `jibres_XXXXXXX`.`products` ADD `compareatprice` bigint(20) UNSIGNED DEFAULT NULL AFTER `slug`;
ALTER TABLE `jibres_XXXXXXX`.`products` ADD `discount` bigint(20) DEFAULT NULL AFTER `slug`;
ALTER TABLE `jibres_XXXXXXX`.`products` ADD `discountpercent` int(10) DEFAULT NULL AFTER `slug`;
ALTER TABLE `jibres_XXXXXXX`.`products` ADD `vatprice` BIGINT(20) UNSIGNED NULL DEFAULT NULL AFTER `slug`;
ALTER TABLE `jibres_XXXXXXX`.`products` ADD `finalprice` bigint(20) DEFAULT NULL AFTER `slug`;


UPDATE `jibres_XXXXXXX`.`products` SET jibres_XXXXXXX.products.buyprice        =
	(
		SELECT jibres_XXXXXXX.productprices.buyprice FROM jibres_XXXXXXX.productprices
		WHERE jibres_XXXXXXX.productprices.product_id = jibres_XXXXXXX.products.id
		ORDER BY jibres_XXXXXXX.productprices.id DESC LIMIT 1
	);

UPDATE `jibres_XXXXXXX`.`products` SET jibres_XXXXXXX.products.price           =
	(
		SELECT jibres_XXXXXXX.productprices.price FROM jibres_XXXXXXX.productprices
		WHERE jibres_XXXXXXX.productprices.product_id = jibres_XXXXXXX.products.id
		ORDER BY jibres_XXXXXXX.productprices.id DESC LIMIT 1
	);

UPDATE `jibres_XXXXXXX`.`products` SET jibres_XXXXXXX.products.compareatprice  =
	(
		SELECT jibres_XXXXXXX.productprices.compareatprice FROM jibres_XXXXXXX.productprices
		WHERE jibres_XXXXXXX.productprices.product_id = jibres_XXXXXXX.products.id
		ORDER BY jibres_XXXXXXX.productprices.id DESC LIMIT 1
	);

UPDATE `jibres_XXXXXXX`.`products` SET jibres_XXXXXXX.products.discount        =
	(
		SELECT jibres_XXXXXXX.productprices.discount FROM jibres_XXXXXXX.productprices
		WHERE jibres_XXXXXXX.productprices.product_id = jibres_XXXXXXX.products.id
		ORDER BY jibres_XXXXXXX.productprices.id DESC LIMIT 1
	);

UPDATE `jibres_XXXXXXX`.`products` SET jibres_XXXXXXX.products.discountpercent =
	(
		SELECT jibres_XXXXXXX.productprices.discountpercent FROM jibres_XXXXXXX.productprices
		WHERE jibres_XXXXXXX.productprices.product_id = jibres_XXXXXXX.products.id
		ORDER BY jibres_XXXXXXX.productprices.id DESC LIMIT 1
	);

UPDATE `jibres_XXXXXXX`.`products` SET jibres_XXXXXXX.products.vatprice        =
	(
		SELECT jibres_XXXXXXX.productprices.vatprice FROM jibres_XXXXXXX.productprices
		WHERE jibres_XXXXXXX.productprices.product_id = jibres_XXXXXXX.products.id
		ORDER BY jibres_XXXXXXX.productprices.id DESC LIMIT 1
	);

UPDATE `jibres_XXXXXXX`.`products` SET jibres_XXXXXXX.products.finalprice      =
	(
		SELECT jibres_XXXXXXX.productprices.finalprice FROM jibres_XXXXXXX.productprices
		WHERE jibres_XXXXXXX.productprices.product_id = jibres_XXXXXXX.products.id
		ORDER BY jibres_XXXXXXX.productprices.id DESC LIMIT 1
	);
