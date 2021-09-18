<?php
namespace lib\db\discount;


class delete
{

	public static function by_id($_id)
	{
		$query  = "DELETE FROM discount WHERE discount.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;

	}

}
?>
