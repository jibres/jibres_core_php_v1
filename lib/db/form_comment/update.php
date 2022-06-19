<?php
namespace lib\db\form_comment;


class update
{

	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('form_comment', $_args, $_id);
	}

	public static function set_whole_dateview(string $_form_comment_ids)
	{
		$date = date("Y-m-d H:i:s");
		$query  =
		"
			UPDATE
				form_comment
			SET
				form_comment.view = 1,
				form_comment.dateview = :date
			WHERE
				form_comment.id IN ($_form_comment_ids)
		";

		$param = [':date' => $date];

		$result = \dash\pdo::query($query, $param);

		return $result;

	}

}
?>
