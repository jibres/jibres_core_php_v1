<?php
namespace lib\app\form\form;


class get
{
	public static function get($_id)
	{
		\dash\permission::access('_group_form');

		return self::public_get($_id);

	}


	public static function public_get($_id)
	{

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$load = \lib\db\form\get::by_id($id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\app\form\form\ready::row($load);

		return $load;
	}
}
?>