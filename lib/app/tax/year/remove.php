<?php
namespace lib\app\tax\year;


class remove
{

	public static function remove($_id)
	{
		$load = \lib\app\tax\year\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$check = \lib\db\tax_year\get::not_use_in_docdetail($load['id']);
		if(isset($check['id']))
		{
			\dash\notif::error(T_("Can not remove this year. This accounting year already in use"));
			return false;
		}

		\lib\db\tax_year\delete::by_id($load['id']);

		\dash\notif::ok(T_("Data removed"));

		return true;
	}

}
?>