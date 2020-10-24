<?php
namespace lib\app\form\comment;


class get
{
	public static function get($_answer_id)
	{

		$load_answer = \lib\app\form\answer\get::by_id($_answer_id);
		if(!$load_answer)
		{
			return false;
		}

		$list = \lib\db\form_comment\get::get_by_answer_id($_answer_id);

		return $list;

	}
}
?>