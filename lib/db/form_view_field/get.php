<?php
namespace lib\db\form_view_field;


class get
{

	public static function get_by_view_id($_id)
	{
		$query = "SELECT * FROM form_view_field WHERE form_view_field.view_id = $_id ";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>
