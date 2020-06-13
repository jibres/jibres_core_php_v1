<?php
namespace content_b1\user\address\fetch;


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

		\content_b1\user\address::set_user_id($user_id);

		$detail = \content_b1\user\address::list_address();

		\content_b1\tools::say($detail);
	}
}
?>