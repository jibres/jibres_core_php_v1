<?php
namespace lib\app\form\view;


class get
{
	public static function get($_id)
	{

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$load = \lib\db\form_view\get::by_id($id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\app\form\view\ready::row($load);

		return $load;
	}
}
?>