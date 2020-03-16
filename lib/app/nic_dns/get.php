<?php
namespace lib\app\nic_dns;


class get
{
	public static function load()
	{
		$id = \dash\request::get('id');
		$result = self::get($id);
		return $result;

	}


	public static function get($_id)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$get = \lib\db\nic_dns\get::by_id_user_id($id, \dash\user::id());

		if(isset($get['id']))
		{
			$get['count_useage'] = intval(\lib\db\nic_domain\get::count_usage_dns($get['id']));
		}

		return $get;

	}
}
?>