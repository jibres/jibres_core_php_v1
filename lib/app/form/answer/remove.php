<?php
namespace lib\app\form\answer;


class remove
{
	public static function remove($_answer_id)
	{
		\dash\permission::access('FormRemoveAnswer');

		$answer_id = \dash\validate::id($_answer_id);
		if(!$answer_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		\lib\db\form_answerdetail\delete::by_answer_id($answer_id);
		\lib\db\form_answer\delete::by_id($answer_id);
		return true;
	}
}
?>