<?php
namespace lib\app\factor;


class remove
{
	public static function remove($_id)
	{
		$load_detail = \lib\app\factor\get::by_id($_id);
		if(!$load_detail || !isset($load_detail['status']))
		{
			return false;
		}

		if($load_detail['status'] === 'deleted')
		{
			\dash\notif::error(T_("This order was deleted before"));
			return false;
		}
		else
		{
			\lib\db\factors\update::record(['status' => 'deleted'], $load_detail['id']);
			\dash\notif::ok(T_("Order was deleted"));
			return true;
		}

	}
}
?>