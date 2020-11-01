<?php
namespace lib\app\form\answer;


class get
{
	public static function by_id($_id)
	{
		\dash\permission::access('_group_form');

		return self::public_by_id($_id);
	}


	public static function public_by_id($_id)
	{

		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load_detail = \lib\db\form_answer\get::by_id($id);
		if(!$load_detail)
		{
			\dash\notif::error(T_("Answer not found"));
			return false;
		}

		return $load_detail;
	}
}
?>