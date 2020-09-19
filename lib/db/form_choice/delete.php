<?php
namespace lib\db\form_choice;


class delete
{

	public static function by_id($_id)
	{
		$query  = "DELETE FROM form_choice WHERE form_choice.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;

	}

}
?>
