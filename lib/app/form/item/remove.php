<?php
namespace lib\app\form\item;


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
}
?>