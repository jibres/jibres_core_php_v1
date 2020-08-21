<?php
namespace lib\db\form_answer;


class delete
{

	public static function by_id($_id)
	{
		$query  = "DELETE FROM form_answer WHERE form_answer.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;

	}

}
?>
