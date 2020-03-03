<?php
namespace content_v2\user\address\add;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');

		$user_id = \dash\coding::decode($id);
		if(!$user_id)
		{
			\dash\notif::error(T_("Invalid user id"));
			return false;
		}

		\content_v2\user\address::set_user_id($user_id);

		$detail = \content_v2\user\address::add_address();


		\content_v2\tools::say($detail);
	}
}
?>