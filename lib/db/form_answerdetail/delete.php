<?php
namespace lib\db\form_answerdetail;


class delete
{

	public static function by_id($_id)
	{
		$query  = "DELETE FROM form_answerdetail WHERE form_answerdetail.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;

	}

}
?>
