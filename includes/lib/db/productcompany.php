<?php
namespace lib\db;


class productcompany
{

	public static function insert()
	{
		\dash\db\config::public_insert('productcompany', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function update()
	{
		return \dash\db\config::public_update('productcompany', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('productcompany', ...func_get_args());
	}




	public static function get_list($_store_id)
	{
		$query =
		"
			SELECT
				productcompany.id,
				productcompany.title,
				(SELECT COUNT(*) FROM products WHERE products.company_id = productcompany.id) AS `count`
			FROM
				productcompany
			WHERE
				productcompany.store_id = $_store_id
			ORDER BY
				count DESC
		";
		$result = \dash\db::get($query);

		return $result;
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('productcompany', ...func_get_args());
	}

	// get one record of product company
	public static function get_one($_store_id, $_id)
	{
		$query  = "SELECT * FROM productcompany WHERE  productcompany.store_id = $_store_id AND productcompany.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	// get one company by title to check is duplicate title or no
	public static function get_by_title($_store_id, $_title)
	{
		$query =
		"
			SELECT
				productcompany.id,
				productcompany.title
			FROM
				productcompany
			WHERE
				productcompany.store_id = $_store_id AND
				productcompany.title = '$_title'
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function delete($_id)
	{
		$query  = "DELETE FROM productcompany WHERE productcompany.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>
