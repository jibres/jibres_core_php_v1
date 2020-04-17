<?php
namespace lib\app\gift;


class get
{
	public static function by_id($_id)
	{
		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\db\gift\get::by_id($id);

		if(!$load)
		{
			\dash\notif::error(T_("Gift detail not found"));
			return false;
		}

		$load = \lib\app\gift\ready::row($load);

		return $load;
	}
}
?>