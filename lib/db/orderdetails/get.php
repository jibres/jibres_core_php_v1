<?php
namespace lib\db\orderdetails;

class get
{

	public static function by_order_id(float $_factor_id) : array
	{
		$query =
		"
			SELECT
				factordetails.*,
				products.title,
				products.trackquantity,
				products.instock,
				products.status,
				products.optionname1,
				products.optionvalue1,
				products.optionname2,
				products.optionvalue2,
				products.optionname3,
				products.optionvalue3,
				products.thumb,
				products.price AS `product_price`,
				products.discount AS `product_discount`,
				products.buyprice AS `product_buyprice`,
				products.id as `product_id`,
				(SELECT productinventory.stock FROM productinventory WHERE productinventory.product_id = products.id ORDER BY productinventory.id DESC LIMIT 1) AS `stock`,
				productunit.title AS `unit`
			FROM
				factordetails
			INNER JOIN products ON products.id = factordetails.product_id
			LEFT JOIN productunit ON productunit.id = products.unit_id

			WHERE
				factordetails.factor_id = :factorid
		";

		$param  =
		[
			':factorid' => $_factor_id,
		];

		$result = \dash\pdo::get($query, $param);

		if(!is_array($result))
		{
			$result = [];
		}

		return $result;
	}
}
?>