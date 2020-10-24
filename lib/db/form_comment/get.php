<?php
namespace lib\db\form_comment;


class get
{
	public static function get_by_answer_id($_answer_id)
	{
		$query = "SELECT * FROM form_comment WHERE form_comment.answer_id = $_answer_id  ORDER BY form_comment.id DESC";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function get($_id)
	{
		$query = "SELECT * FROM form_comment WHERE form_comment.id = $_id  LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

}
?>
