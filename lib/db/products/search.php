<?php
namespace lib\db\products;

class search
{

	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM products $q[join] $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query = "SELECT products.* FROM products $q[join] $q[where] $q[order] $limit ";

		$result = \dash\pdo::get($query);

		return $result;
	}



	public static function list_join_price_factor_count($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM products $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}


		$query =
		"
			SELECT
				products.*,
				(SELECT COUNT(*) FROM factordetails WHERE factordetails.product_id = products.id) AS `count_sale`
			FROM products
				$q[where]
			ORDER BY `count_sale` DESC
				 $limit
		";


		$result = \dash\pdo::get($query);


		return $result;
	}





	public static function get_similar_product($_id, $_limit)
	{
		$query =
		"
			SELECT
				productcategoryusage.productcategory_id AS `productcategory_id`
			FROM productcategoryusage
			WHERE
				productcategoryusage.product_id = $_id OR productcategoryusage.product_id = (SELECT products.parent FROM products WHERE products.id = $_id LIMIT 1)
		";

		$ids = \dash\pdo::get($query, [], 'productcategory_id');

		if(!$ids || !is_array($ids))
		{
			return false;
		}

		$ids = array_filter($ids);
		$ids = array_unique($ids);

		if(!$ids)
		{
			return false;
		}

		$ids = implode(',', $ids);

		$query =
		"
			SELECT
				products.*
			FROM
				products
			WHERE products.id IN
			(
				SELECT
					products.id
				FROM products
				INNER JOIN productcategoryusage ON productcategoryusage.product_id = products.id
				WHERE
					products.status = 'active' AND
					products.id != $_id AND
					productcategoryusage.productcategory_id IN ($ids)
				GROUP BY products.id
				ORDER BY products.instock ASC, (SELECT COUNT(*) FROM factordetails WHERE factordetails.product_id = products.id)  DESC
			)
			LIMIT $_limit
		";

		$result = \dash\pdo::get($query);

		return $result;

	}


	public static function get_similar_product_category_last($_id, $_limit, $_found_ids)
	{

		$category_id_query = " SELECT productcategoryusage.productcategory_id AS `category_id` FROM productcategoryusage WHERE productcategoryusage.product_id IN ($_id , (SELECT products.parent FROM products WHERE products.id = $_id)) ";
		$category_id = \dash\db::get($category_id_query, 'category_id');

		if(!$category_id || !is_array($category_id))
		{
			return [];
		}

		$category_id = array_filter($category_id);
		$category_id = array_unique($category_id);

		if(!$category_id)
		{
			return [];
		}

		$category_id = implode(',', $category_id);



		$found_ids = null;
		if($_found_ids)
		{
			$found_ids = " products.id NOT IN (". implode(',', $_found_ids). ") AND";
		}

		$query =
		"
			SELECT
				products.*
			FROM products
			INNER JOIN productcategoryusage ON productcategoryusage.product_id = products.id
			WHERE
				products.status = 'available' AND $found_ids
				products.id != $_id AND
				productcategoryusage.productcategory_id IN ($category_id)
			ORDER BY products.instock ASC, (SELECT COUNT(*) FROM factordetails WHERE factordetails.product_id = products.id)  DESC
			LIMIT $_limit
		";

		$result = \dash\pdo::get($query);

		return $result;

	}


	public static function get_similar_product_last($_id, $_limit, $_found_ids)
	{
		$found_ids = null;
		if($_found_ids)
		{
			$found_ids = " products.id NOT IN (". implode(',', $_found_ids). ") AND";
		}

		$query =
		"
			SELECT
				products.*
			FROM products
			WHERE
				products.status = 'available' AND $found_ids
				products.id != $_id
			ORDER BY products.instock ASC, (SELECT COUNT(*) FROM factordetails WHERE factordetails.product_id = products.id)  DESC
			LIMIT $_limit
		";

		$result = \dash\pdo::get($query);
		return $result;

	}


}
?>