<?php
namespace lib\app\tax\doc;


class remove
{

	public static function remove($_id)
	{
		$load = \lib\app\tax\doc\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$check_parent_not_use = \lib\db\tax_document\get::check_parent_not_use_need_check($load['id']);

		if(isset($check_parent_not_use['id']))
		{
			\dash\notif::error(T_("This record is parent of some other record and cannot be remove"));
			return false;
		}

		\lib\db\tax_document\delete::by_id($load['id']);

		\dash\notif::ok(T_("Data removed"));

		return true;
	}

}
?>