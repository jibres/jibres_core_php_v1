<?php
namespace lib\app\tax\docdetail;


class remove
{

	public static function remove($_id)
	{
		$load = \lib\app\tax\docdetail\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$check_parent_not_use = \lib\db\tax_docdetail\get::check_parent_not_use_need_check($load['id']);

		if(isset($check_parent_not_use['id']))
		{
			\dash\notif::error(T_("This record is parent of some other record and cannot be remove"));
			return false;
		}

		\lib\db\tax_docdetail\delete::by_id($load['id']);

		\dash\notif::ok(T_("Data removed"));

		return true;
	}

}
?>