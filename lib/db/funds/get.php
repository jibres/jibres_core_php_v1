<?php
namespace lib\db\funds;


class get
{

	public static function one($_id)
	{
		$query = "SELECT * FROM funds WHERE id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function all()
	{
		$query = "SELECT * FROM funds";
		$result = \dash\db::get($query	);
		return $result;
	}
}
?>