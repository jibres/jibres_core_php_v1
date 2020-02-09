<?php
namespace lib\app\nic_contact;


class get
{
	public static function load()
	{
		$id = \dash\request::get('id');
		return self::get($id);
	}


	public static function get($_id)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$id = \dash\coding::decode($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$get = \lib\db\nic_contact\get::by_id_user_id($id, \dash\user::id());

		return $get;

	}
}
?>