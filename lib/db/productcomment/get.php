<?php
namespace lib\db\productcomment;


class get
{
	public static function customer_review($_product_id)
	{
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				AVG(productcomment.star) AS `avg`,
				SUM(CASE WHEN productcomment.star = 1 THEN 1 ELSE 0 END) 'star_1',
				SUM(CASE WHEN productcomment.star = 2 THEN 1 ELSE 0 END) 'star_2',
				SUM(CASE WHEN productcomment.star = 3 THEN 1 ELSE 0 END) 'star_3',
				SUM(CASE WHEN productcomment.star = 4 THEN 1 ELSE 0 END) 'star_4',
				SUM(CASE WHEN productcomment.star = 5 THEN 1 ELSE 0 END) 'star_5'

			FROM
				productcomment
			WHERE
				productcomment.status     = 'approved' AND
				(
					productcomment.product_id = $_product_id OR
					productcomment.product_id IN (SELECT products.id FROM products WHERE products.parent = $_product_id) OR
					productcomment.product_id IN (SELECT products.id FROM products WHERE products.parent = (SELECT products.parent FROM products WHERE products.id = $_product_id))
				)

		";
		$result = \dash\db::get($query, null, true);

		return $result;
	}


	public static function count_product($_product_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM productcomment WHERE productcomment.product_id = $_product_id  ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}



	public static function get()
	{
		return \dash\db\config::public_get('productcomment', ...func_get_args());
	}


	// get product comment for one user and product to check not duplicate
	public static function check_duplicate($_user_id, $_product_id)
	{
		$query =
		"
			SELECT
				productcomment.id,
				productcomment.content,
				productcomment.star
			FROM
				productcomment
			WHERE
				productcomment.user_id = $_user_id AND
				productcomment.product_id   = $_product_id
			LIMIT 1
		";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	// get one record of product comment
	public static function get_one_by_detail($_id)
	{
		$query  =
		"
			SELECT
				productcomment.id,
				productcomment.content,
				productcomment.title,
				productcomment.star,
				productcomment.status,
				productcomment.datecreated,
				productcomment.datemodified,
				productcomment.user_id,
				users.avatar,
				users.displayname,
				users.gender
			FROM
				productcomment
			INNER JOIN users ON users.id = productcomment.user_id
			WHERE
				productcomment.id = $_id
			LIMIT 1
		";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	// get one record of product comment
	public static function get_one($_id)
	{
		$query  = "SELECT * FROM productcomment WHERE  productcomment.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	// get one record of product comment
	public static function by_id($_id)
	{
		$query  = "SELECT * FROM productcomment WHERE  productcomment.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_parent($_parent_id)
	{
		$query  = "SELECT * FROM productcomment WHERE  productcomment.parent = $_parent_id ";
		$result = \dash\db::get($query);
		return $result;
	}





	public static function get_page_list($_string = null, $_product_id = null, $_status = null)
	{
		$q = null;
		if(isset($_string))
		{
			$_string = \dash\safe::safe($_string);
			$q       = "AND productcomment.content LIKE '%$_string%' ";
		}

		$status = null;
		if(isset($_status))
		{
			$status = "AND productcomment.status = '$_status' ";
		}

		$product_id = null;
		if(isset($_product_id) && is_numeric($_product_id))
		{
			$product_id = "AND productcomment.product_id = $_product_id ";
		}

		$pagination_query =
		"
			SELECT
				COUNT(*) AS `count`
			FROM
				productcomment
			WHERE 1
				$q $product_id $status
		";

		$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query);

		$query =
		"
			SELECT
				productcomment.id,
				productcomment.content,
				productcomment.star,
				productcomment.status,
				productcomment.datecreated,
				productcomment.user_id,
				users.avatar,
				users.displayname,
				users.gender
			FROM
				productcomment
			LEFT JOIN users ON users.id = productcomment.user_id
			WHERE 1
				$q $product_id $status
			ORDER BY
				productcomment.datecreated DESC
			$limit
		";
		$result = \dash\db::get($query);

		return $result;
	}
}
?>
