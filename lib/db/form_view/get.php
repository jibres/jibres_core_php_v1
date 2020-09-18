<?php
namespace lib\db\form_view;


class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM form_view WHERE form_view.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>
