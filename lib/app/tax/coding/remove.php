<?php
namespace lib\app\tax\coding;


class remove
{

	public static function remove($_id)
	{
		$load = \lib\app\tax\coding\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$check_parent_not_use = \lib\db\tax_coding\get::check_parent_not_use($load['id']);

		if(isset($check_parent_not_use['id']))
		{
			\dash\notif::error(T_("This record is parent of some other record and cannot be remove"));
			return false;
		}

		\dash\db\userlegal\update::set_null_accounting($load['id']);

		\lib\db\tax_coding\delete::by_id($load['id']);

		\dash\notif::ok(T_("Data removed"));

		return true;
	}

}
?>