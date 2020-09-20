<?php
namespace lib\app\form\filter;


class remove
{

	public static function remove($_id)
	{

		$load = \lib\app\form\item\get::get($_id);
		if(!$load)
		{
			return false;
		}

		\lib\db\form_item\update::update(['status' => 'deleted'], $_id);

		\dash\notif::ok(T_("Item removed"));

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