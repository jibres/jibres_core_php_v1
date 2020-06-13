<?php
namespace content_b1\user\address\edit;


class model
{
	public static function patch()
	{
		$id = \dash\request::get('id');

		$user_id = \dash\coding::decode($id);
		if(!$user_id)
		{
			\dash\notif::error(T_("Invalid user id"));
			return false;
		}

		$addressid = \dash\request::get('addressid');

		\content_b1\user\address::set_user_id($user_id);

		$detail = \content_b1\user\address::edit_address($addressid);

		\content_b1\tools::say($detail);
	}
}
?>