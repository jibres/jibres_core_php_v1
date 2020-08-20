<?php
namespace lib\db\form_item;


class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM form_item WHERE form_item.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>
