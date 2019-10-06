<?php
namespace lib\db;


class productguarantee
{

	public static function insert()
	{
		\dash\db\config::public_insert('productguarantee', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function update()
	{
		return \dash\db\config::public_update('productguarantee', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('productguarantee', ...func_get_args());
	}


	public static function get_page_list($_store_id, $_string = null)
	{
		$q = null;
		if(isset($_string))
		{
			$_string = \dash\db\safe::value($_string);
			$q       = "AND productguarantee.title LIKE '%$_string%' ";
		}

		$pagination_query =
		"
			SELECT
				COUNT(*) AS `count`
			FROM
				productguarantee
			WHERE
				productguarantee.store_id = $_store_id
				$q
		";

		$limit = \dash\db::pagination_query($pagination_query);

		$query =
		"
			SELECT
				productguarantee.id,
				productguarantee.title,
				(SELECT COUNT(*) FROM products WHERE products.guarantee_id = productguarantee.id) AS `count`
			FROM
				productguarantee
			WHERE
				productguarantee.store_id = $_store_id
				$q
			ORDER BY
				count DESC
			$limit
		";
		$result = \dash\db::get($query);

		return $result;
	}



	public static function get_list($_store_id)
	{
		$query =
		"
			SELECT
				productguarantee.id,
				productguarantee.title,
				(SELECT COUNT(*) FROM products WHERE products.guarantee_id = productguarantee.id) AS `count`
			FROM
				productguarantee
			WHERE
				productguarantee.store_id = $_store_id
			ORDER BY
				count DESC
		";
		$result = \dash\db::get($query);

		return $result;
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('productguarantee', ...func_get_args());
	}

	// get one record of product guarantee
	public static function get_one($_store_id, $_id)
	{
		$query  = "SELECT * FROM productguarantee WHERE  productguarantee.store_id = $_store_id AND productguarantee.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	// get one guarantee by title to check is duplicate title or no
	public static function get_by_title($_store_id, $_title)
	{
		$query =
		"
			SELECT
				productguarantee.id,
				productguarantee.title
			FROM
				productguarantee
			WHERE
				productguarantee.store_id = $_store_id AND
				productguarantee.title = '$_title'
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function delete($_id)
	{
		$query  = "DELETE FROM productguarantee WHERE productguarantee.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>
