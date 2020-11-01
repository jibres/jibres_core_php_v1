<?php
namespace lib\app\form\view;


class field
{
	public static function get_by_view_id($_id)
	{
		\dash\permission::access('AdvanceFormAnalyze');

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$load = \lib\db\form_view_field\get::get_by_view_id($id);

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