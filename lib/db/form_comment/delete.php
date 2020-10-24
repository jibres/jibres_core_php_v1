<?php
namespace lib\db\form_comment;


class delete
{

	public static function record($_id)
	{
		$query = "DELETE FROM form_comment WHERE form_comment.id = $_id  LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>
