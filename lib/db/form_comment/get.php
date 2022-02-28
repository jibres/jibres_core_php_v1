<?php
namespace lib\db\form_comment;


class get
{
	public static function get_by_answer_id($_answer_id)
	{
		$query =
		"
			SELECT
				form_comment.*,
				users.mobile,
				users.displayname
			FROM
				form_comment
			LEFT JOIN users ON users.id = form_comment.user_id
			WHERE
				form_comment.answer_id = $_answer_id
			ORDER BY form_comment.id DESC
		";
		$result = \dash\pdo::get($query);
		return $result;
	}

	public static function get_by_answer_id_public($_answer_id)
	{
		$query = "SELECT * FROM form_comment WHERE form_comment.answer_id = $_answer_id AND form_comment.privacy = 'public'  ORDER BY form_comment.id DESC";
		$result = \dash\pdo::get($query);
		return $result;
	}




	public static function get($_id)
	{
		$query = "SELECT * FROM form_comment WHERE form_comment.id = $_id  LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}

}
?>
