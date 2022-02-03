<?php
namespace dash\app\permission;


class remove
{
	public static function remove($_id)
	{

		$load = \dash\app\permission\get::get($_id);
		if(!$load)
		{
			return false;
		}

		// check user count

		if(a($load, 'key'))
		{
			$list = \dash\db\users\get::who_have_permission($load['key']);

			if($list && is_array($list))
			{
				foreach ($list as $key => $value)
				{
					\dash\app\user::quick_update(['permission' => null], $value['id']);
				}
			}
		}

		\lib\db\setting\delete::record($_id);

		\dash\notif::ok(T_("Permission removed"));
		return true;

	}
}
?>
