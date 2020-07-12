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

	public static function all_title()
	{
		$query = "SELECT DISTINCT ir_vat.title AS `title` FROM ir_vat";
		$result = \dash\db::get($query, 'title');
		return $result;
	}

	public static function all()
	{
		$query = "SELECT * FROM ir_vat";
		$result = \dash\db::get($query	);
		return $result;
	}

	public static function total_factor()
	{
		$query = "SELECT SUM(ir_vat.total) AS `total` FROM ir_vat";
		$result = \dash\db::get($query, 'total', true);
		return $result;
	}
}
?>