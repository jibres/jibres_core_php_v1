<?php
namespace lib\db\discount_lookup;


class delete
{

	public static function by_discount_id($_id)
	{
		$query  = "DELETE FROM discount_lookup WHERE discount_lookup.discount_id = $_id ";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>