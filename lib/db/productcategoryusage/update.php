<?php
namespace lib\db\productcategoryusage;


class update
{
	public static function category_usage_cat_id($_old_id, $_new_id)
	{
		$query  =
		"
			DELETE FROM
				productcategoryusage
			WHERE
				productcategoryusage.productcategory_id = $_old_id AND
				productcategoryusage.product_id IN
				(
					SELECT x.product_id FROM
					(
						SELECT
							productcategoryusage.product_id
						FROM
							productcategoryusage
						WHERE
							productcategoryusage.productcategory_id = $_old_id OR productcategoryusage.productcategory_id = $_new_id
						GROUP BY productcategoryusage.product_id
						HAVING COUNT(*) >= 2
					)
					AS `x`
				)
		";
		$remove_duplicate = \dash\db::query($query);


		$query  =
		"
			UPDATE
				productcategoryusage
			SET
				productcategoryusage.productcategory_id = $_new_id
			WHERE
				productcategoryusage.productcategory_id = $_old_id

		";
		$result = \dash\db::query($query);
		return $result;
	}


}
?>
