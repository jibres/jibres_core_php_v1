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

		// check not use in any doc detail
		\dash\notif::error('not ready');
		return false;


		\lib\db\tax_yeardetail\delete::by_year_id($load['id']);
		\lib\db\tax_year\delete::by_id($load['id']);

		\dash\notif::ok(T_("Data removed"));

		return true;
	}

}
?>