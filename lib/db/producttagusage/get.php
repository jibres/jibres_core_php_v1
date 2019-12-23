<?php
namespace lib\db\producttagusage;


class get
{


	public static function usage($_product_id)
	{
		if(!$_product_id)
		{
			return false;
		}

		$query =
		"
			SELECT
				producttag.id AS `producttag_id`,
				producttag.title,
				producttag.slug
			FROM
				producttagusage
			INNER JOIN producttag ON producttag.id = producttagusage.producttag_id
			WHERE
				producttagusage.product_id = $_product_id
		";
		$result = \dash\db::get($query);
		return $result;
	}


}
?>
