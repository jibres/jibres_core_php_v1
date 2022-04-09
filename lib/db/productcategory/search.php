<?php
namespace lib\db\productcategory;

class search
{

	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\pdo\prepare_query::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =
		"
			SELECT COUNT(*) AS `count` FROM productcategory $q[where]
		";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\pagination::pagination_query($pagination_query, [], $q['limit']);
		}


		$query =
		"
			SELECT
				productcategory.*,
				(
					SELECT
						COUNT(DISTINCT productcategoryusage.id)
					FROM
						productcategoryusage
					INNER JOIN products ON products.id = productcategoryusage.product_id
					WHERE
						productcategoryusage.productcategory_id = productcategory.id AND
						products.status != 'deleted'

				) AS `count`
			FROM
				productcategory
				$q[where]
				$q[order]
				$limit
		";

		$result = \dash\pdo::get($query);

		return $result;
	}



}
?>