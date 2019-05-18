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
