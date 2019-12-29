<?php
namespace lib\db\factordetails;

class get
{
	public static function by_multi_factor_id($_ids)
	{
		$query = "SELECT * FROM factordetails WHERE factordetails.factor_id IN ($_ids)";
		$result = \dash\db::get($query);
		return $result;
	}



	public static function by_factor_id($_id)
	{
		$query = "SELECT * FROM factordetails WHERE factordetails.factor_id = $_id";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function by_factor_id_join_product($_id)
	{
		$query =
		"
			SELECT
				factordetails.*,
				products.title AS `title`
			FROM
				factordetails
			INNER JOIN products ON products.id = factordetails.product_id
			WHERE
				factordetails.factor_id = $_id
		";
		$result = \dash\db::get($query);
		return $result;
	}


}
?>
