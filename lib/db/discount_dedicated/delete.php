<?php
namespace lib\db\discount_dedicated;


class delete
{
	public static function multi_remove($_ids)
	{
		$ids    = array_map('floatval', $_ids);
		$ids    = implode(',', $ids);
		$query  = "DELETE FROM discount_dedicated WHERE discount_dedicated.id IN ($ids) ";
		$result = \dash\pdo::get($query);
		return $result;
	}

	public static function by_discount_id($_id)
	{
		$query  = "DELETE FROM discount_dedicated WHERE discount_dedicated.discount_id = $_id ";
		$result = \dash\pdo::get($query);
		return $result;
	}
}
?>