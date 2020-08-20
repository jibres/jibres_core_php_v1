<?php
namespace lib\db\form;


class delete
{

	public static function by_id($_id)
	{
		$query  = "DELETE FROM form WHERE form.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;

	}

}
?>
