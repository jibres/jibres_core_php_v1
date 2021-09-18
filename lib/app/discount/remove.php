<?php
namespace lib\app\discount;


class remove
{

	public static function remove($_id)
	{
		$load = \lib\app\discount\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$check_parent_not_use = \lib\db\discount\get::check_parent_not_use($load['id']);

		if(isset($check_parent_not_use['id']))
		{
			\dash\notif::error(T_("This record is parent of some other record and cannot be remove"));
			return false;
		}

		$check_this_not_use = \lib\db\discount\get::check_not_use($load['id']);

		if(isset($check_this_not_use['id']))
		{
			\dash\notif::error(T_("This record is used in some document and cannot be remove"));
			return false;
		}


		\lib\db\discount\delete::by_id($load['id']);

		\dash\notif::ok(T_("Data removed"));

		return true;
	}

}
?>