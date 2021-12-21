<?php
namespace lib\db\discount_dedicated;


class get
{
	public static function by_discount_id($_id)
	{
		$query = "SELECT * FROM discount_dedicated WHERE discount_dedicated.discount_id = $_id ";
		$result = \dash\pdo::get($query);
		return $result;
	}

}
?>