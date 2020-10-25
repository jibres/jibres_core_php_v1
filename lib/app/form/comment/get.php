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


	public static function public_comment($_answer_id)
	{

		$load_answer = \lib\app\form\answer\get::by_id($_answer_id);
		if(!$load_answer)
		{
			return false;
		}

		$list = \lib\db\form_comment\get::get_by_answer_id_public($_answer_id);

		return $list;

	}




	public static function one($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Id not set"));
			return false;
		}

		$load = \lib\db\form_comment\get::get($id);
		if(!$load)
		{
			\dash\notif::error(T_("Comment not found"));
			return false;
		}

		return $load;

	}
}
?>