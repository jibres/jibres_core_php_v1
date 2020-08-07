<?php
namespace lib\app\tax\docdetail;


class remove
{

	public static function remove($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		\lib\db\tax_docdetail\delete::by_id($id);

		\dash\notif::ok(T_("Data removed"));

		return true;
	}

}
?>