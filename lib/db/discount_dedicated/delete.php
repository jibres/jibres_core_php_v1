<?php
namespace lib\db\discount_dedicated;


class delete
{
	public static function multi_remove($_ids)
	{
		$ids    = array_map('floatval', $_ids);
		$ids    = implode(',', $ids);
		$query  = "DELETE FROM discount_dedicated WHERE discount_dedicated.id IN ($ids) ";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>