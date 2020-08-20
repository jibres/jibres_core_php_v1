<?php
namespace lib\db\form_item;


class delete
{

	public static function by_id($_id)
	{
		$query  = "DELETE FROM form_item WHERE form_item.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;

	}

}
?>
