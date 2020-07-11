INSERT IGNORE INTO jibres_XXXXXXX.productstock
(
	`product_id`,
	`sold`,
	`stock`,
	`bought`,
	`datemodified`,
	`minstock`,
	`maxstock`
)
SELECT
	products.id,
 	(SELECT SUM(factordetails.count) FROM jibres_XXXXXXX.factordetails WHERE factordetails.product_id = products.id AND factordetails.count > 0),
 	(SELECT (SUM(factordetails.count) * -1) FROM jibres_XXXXXXX.factordetails WHERE factordetails.product_id = products.id),
 	0,
 	products.datemodified,
 	products.minstock,
 	products.maxstock
 FROM
 	jibres_XXXXXXX.products
 	;