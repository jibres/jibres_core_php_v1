<?php
namespace lib\app\form\filter;


class remove
{

	public static function remove($_id)
	{

		$load = \lib\app\form\filter\get::get($_id);
		if(!$load)
		{
			return false;
		}
		\lib\db\form_filter\delete::delete_where_by_filter_id($_id);
		\lib\db\form_filter\delete::by_id($_id);

		\dash\notif::ok(T_("Filter removed"));

		return true;
	}


	public static function remove_where($_id)
	{

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		\lib\db\form_filter\delete::delete_where_id($id);

		\dash\notif::ok(T_("Condition removed"));

		return true;
	}
}
?>