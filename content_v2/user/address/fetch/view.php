<?php
namespace content_v2\user\address\fetch;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		$user_id = \dash\coding::decode($id);
		if(!$user_id)
		{
			\dash\notif::error(T_("Invalid user id"));
			return false;
		}

		\content_v2\user\address::set_user_id($user_id);

		$detail = \content_v2\user\address::list_address();

		\content_v2\tools::say($detail);
	}
}
?>