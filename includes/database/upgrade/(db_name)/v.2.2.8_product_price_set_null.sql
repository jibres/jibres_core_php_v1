ALTER TABLE `productprices` DROP `startshamsidate`;
ALTER TABLE `productprices` DROP `endshamsidate`;
ALTER TABLE `factors` DROP `shamsidate`;


INSERT INTO productprices
(
	`product_id`,
	`creator`,
	`startdate`,
	`enddate`,
	`buyprice`,
	`price`,
	`discount`,
	`discountpercent`,
	`datecreated`
)

SELECT
	products.id,
	products.creator,
	products.datecreated,
	null,
	products.buyprice,
	products.price,
	products.discount,
	products.discountpercent,
	products.datecreated
FROM
	products
WHERE
	(
		products.buyprice IS NOT NULL OR
		products.price IS NOT NULL OR
		products.discount IS NOT NULL
	)
	AND
	products.id NOT IN
	(
		SELECT myPc.product_id
		FROM productprices AS `myPc`
	);
