<?php
namespace lib\db\irvat;


class get
{

	public static function one($_id)
	{
		$query = "SELECT * FROM ir_vat WHERE id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function all()
	{
		$query = "SELECT * FROM ir_vat";
		$result = \dash\db::get($query	);
		return $result;
	}
}
?>