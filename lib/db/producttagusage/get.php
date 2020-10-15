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


	public static function check_usage_tag($_tag_id)
	{
		$query  = "SELECT * FROM producttagusage WHERE producttagusage.producttag_id = $_tag_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


		public static function check_product_have_tag($_product_id, $_tag_id)
	{
		$query  = "SELECT * FROM producttagusage WHERE producttagusage.producttag_id = $_tag_id AND producttagusage.product_id = $_product_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;

	}


}
?>
