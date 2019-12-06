<?php
namespace lib\app\customer;

class credit
{

	public static function set($_credit, $_id)
	{
		if(!is_numeric($_credit))
		{
			\dash\notif::error(T_("Please set the credit as a number"), 'credit');
			return false;
		}

		$credit = intval($_credit);
		$credit = abs($credit);

		if($credit > 1E+19)
		{
			\dash\notif::error(T_("Credit number is out of range"), 'credit');
			return false;
		}

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid customer id"));
			return false;
		}

		$result = \lib\db\users::update(['credit' => $credit], $id);

		if($result)
		{
			\dash\notif::ok(T_("Update credit successfully"));
			return true;

		}
		else
		{
			\dash\notif::error(T_("Can not update credit"));
			return false;
		}


	}
}
?>