<?php
namespace lib\app\form\answer;


class edit
{

	public static function makr_all_as_review($_form_id)
	{
		$id = \dash\validate::id($_form_id);

		if(!$id)
		{
			return false;
		}

		\lib\db\form_answer\edit::makr_all_as_review($id);

		\dash\notif::ok(T_("All answer of this form mark as reviewd"));

		return true;
	}



	public static function makr_as_review($_form_id, $_answer_id)
	{
		$id = \dash\validate::id($_form_id);

		if(!$id)
		{
			return false;
		}

		$answer_id = \dash\validate::id($_answer_id);

		if(!$answer_id)
		{
			return false;
		}


		\lib\db\form_answer\edit::makr_as_review($id, $answer_id);

		\dash\notif::ok(T_("Answer mark as reviewd"));

		return true;

	}
}
?>