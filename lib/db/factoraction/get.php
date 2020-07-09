<?php
namespace lib\db\factoraction;


class get
{

	public static function one($_id)
	{
		$query = "SELECT * FROM factoraction WHERE id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function all()
	{
		$query = "SELECT * FROM factoraction";
		$result = \dash\db::get($query	);
		return $result;
	}
}
?>