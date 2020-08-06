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

		\lib\db\tax_coding\delete::by_id($load['id']);

		\dash\notif::ok(T_("Data removed"));

		return true;
	}

}
?>