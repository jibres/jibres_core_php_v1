INSERT INTO jibres_XXXXXXX.comments
(
	`product_id`,
	`factor_id`,
	`for`,
	`user_id`,
	`title`,
	`content`,
	`status`,
	`parent`,
	`star`,
	`datecreated`,
	`datemodified`,
	`ip`
)
SELECT
	productcomment.product_id,
	productcomment.factor_id,
	'product',
	productcomment.user_id,
	productcomment.title,
	productcomment.content,
	productcomment.status,
	productcomment.parent,
	productcomment.star,
	productcomment.datecreated,
	productcomment.datemodified,
	productcomment.ip
FROM
jibres_XXXXXXX.productcomment;
