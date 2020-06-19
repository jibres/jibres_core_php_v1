<?php
namespace lib\db\productcategory;

class search
{
	private static function ready_to_sql($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$where = null;
		$q     = [];

		if($_and)
		{
			$_and = implode(' AND ', $_and);
			$q[] = "$_and";

		}

		if($_or)
		{
			$_or = implode(' OR ', $_or);
			$q[] = "($_or)";
		}

		if($q)
		{
			$where = 'WHERE '. implode(" AND ", $q);
		}

		$order = null;
		if($_order_sort && is_string($_order_sort))
		{
			$order = $_order_sort;
		}

		$pagination = null;
		if(array_key_exists('pagination', $_meta))
		{
			$pagination = $_meta['pagination'];
		}

		$limit = null;
		if(array_key_exists('limit', $_meta))
		{
			$limit = $_meta['limit'];
		}

		return
		[
			'where'      => $where,
			'order'      => $order,
			'pagination' => $pagination,
			'limit'      => $limit,
		];
	}


	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = self::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =
		"
			SELECT COUNT(*) AS `count` FROM productcategory $q[where]
		";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}


		$query =
		"
			SELECT
				productcategory.*,
				(SELECT COUNT(*) FROM products WHERE products.cat_id = productcategory.id) AS `count`,
				(
					IF(productcategory.parent1 IS NOT NULL ,
					(
						SELECT
							CONCAT('[',GROUP_CONCAT(CONCAT('{\"id\":\"', myPcat.id ,'\", \"title\":\"', myPcat.title, '\", \"slug\":\"',myPcat.slug,'\"}')), ']')
						FROM
							productcategory AS `myPcat`
						WHERE myPcat.id IN (productcategory.parent1, productcategory.parent2, productcategory.parent3)
					), NULL)
				) AS `parent_json`,
				(
					SELECT 1
					FROM productcategory AS `myHchild`
					WHERE myHchild.parent1 = productcategory.id
					OR myHchild.parent2 = productcategory.id
					OR myHchild.parent3 = productcategory.id
					LIMIT 1
				)
				AS `have_child`
			FROM
				productcategory
				$q[where]
				$q[order]
				$limit
		";

		$result = \dash\db::get($query);

		return $result;
	}



}
?>