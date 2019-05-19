<?php
namespace lib\db;


class productcomment
{

	public static function insert()
	{
		\dash\db\config::public_insert('productcomment', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function update()
	{
		return \dash\db\config::public_update('productcomment', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('productcomment', ...func_get_args());
	}


	// get product comment for one user and product to check not duplicate
	public static function check_duplicate($_store_id, $_userstore_id, $_product_id)
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
				productcomment.store_id     = $_store_id AND
				productcomment.userstore_id = $_userstore_id AND
				productcomment.product_id   = $_product_id
			LIMIT 1
		";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	// get one record of product comment
	public static function get_one($_store_id, $_id)
	{
		$query  = "SELECT * FROM productcomment WHERE  productcomment.store_id = $_store_id AND productcomment.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function delete($_id)
	{
		$query  = "DELETE FROM productcomment WHERE productcomment.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>
