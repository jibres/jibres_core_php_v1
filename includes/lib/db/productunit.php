<?php
namespace lib\db;


class productunit
{

	public static function insert()
	{
		\dash\db\config::public_insert('productunit', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function update()
	{
		return \dash\db\config::public_update('productunit', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('productunit', ...func_get_args());
	}


	public static function get_list($_store_id)
	{
		$query =
		"
			SELECT
				productunit.id,
				productunit.title,
				productunit.int,
				productunit.maxsale,
				(SELECT COUNT(*) FROM products WHERE products.unit_id = productunit.id) AS `count`
			FROM
				productunit
			WHERE
				productunit.store_id = $_store_id
			ORDER BY
				count DESC
		";
		$result = \dash\db::get($query);

		return $result;
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('productunit', ...func_get_args());
	}

	// get one record of product unit
	public static function get_one($_store_id, $_id)
	{
		$query  = "SELECT * FROM productunit WHERE  productunit.store_id = $_store_id AND productunit.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	// get one unit by title to check is duplicate title or no
	public static function get_by_title($_store_id, $_title)
	{
		$query =
		"
			SELECT
				productunit.id,
				productunit.title
			FROM
				productunit
			WHERE
				productunit.store_id = $_store_id AND
				productunit.title = '$_title'
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true);
		return $result;
	}


	// user add new unit and set it ad default
	// we change all old record of this store as not default
	public static function set_all_default_as_null($_store_id)
	{
		$query =
		"
			UPDATE
				productunit
			SET
				productunit.isdefault = NULL
			WHERE
				productunit.store_id = $_store_id AND
				productunit.isdefault IS NOT NULL
		";

		$result = \dash\db::query($query);
		return $result;
	}


	public static function delete($_id)
	{
		$query  = "DELETE FROM productunit WHERE productunit.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>
