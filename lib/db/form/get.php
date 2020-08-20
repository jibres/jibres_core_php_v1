<?php
namespace lib\db\form;


class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM form WHERE form.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>
