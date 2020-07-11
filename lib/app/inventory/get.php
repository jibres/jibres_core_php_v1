<?php
namespace lib\app\inventory;


class get
{


	public static function inline_get($_id)
	{
		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid inventory id"));
			return false;
		}

		$load = \lib\db\inventory\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid inventory id"));
			return false;
		}

		return $load;
	}


	public static function get($_id)
	{

		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid inventory id"));
			return false;
		}

		$load = \lib\db\inventory\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid inventory id"));
			return false;
		}

		return $load;
	}


	public static function all()
	{
		$result = \lib\db\inventory\get::all();
		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\inventory\\ready', 'row'], $result);

		return $result;
	}

}
?>