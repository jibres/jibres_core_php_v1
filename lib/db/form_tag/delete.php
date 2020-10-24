<?php
namespace lib\db\form_tag;


class delete
{
	public static function record($_id)
	{
		$query = "DELETE FROM form_tag WHERE form_tag.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>