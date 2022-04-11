<?php
namespace lib\app\nic_contact;


class get
{
	public static function load()
	{
		$id = \dash\request::get('id');

		$result = self::get($id);

		if($result)
		{
			$result = \lib\app\nic_contact\ready::row($result);
		}

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

		$get = \lib\db\nic_contact\get::by_id_user_id($id, \dash\user::id());

		return $get;

	}




	public static function info($_irnic_id)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$irnic_id = \dash\validate::irnic_id($_irnic_id);


		if(!$irnic_id)
		{
			\dash\notif::error(T_("Invalid irnic id"));
			return false;
		}

		$contact_info =  \lib\api\nic\exec\contact_check::info($irnic_id);

		return $contact_info;
	}
}
?>