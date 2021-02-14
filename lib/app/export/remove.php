<?php
namespace lib\app\export;

class remove
{

	public static function request($_type, $_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$check = \lib\db\export\get::by_id($id);
		if(isset($check['type']) && $check['type'] === $_type)
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Invalid request id"));
			return false;
		}

		if(isset($check['status']) && $check['status'] === 'running')
		{
			\dash\notif::error(T_("Can not remove running request"));
			return false;
		}

		\lib\db\export\delete::delete($id);

		\dash\notif::ok(T_("Data removed"));
		return true;
	}
}
?>