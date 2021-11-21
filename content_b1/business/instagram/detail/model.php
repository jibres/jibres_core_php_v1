<?php
namespace content_b1\business\instagram\detail;


class model
{

	public static function post()
	{
		$args             = [];

		if($access_token = \dash\request::input_body('access_token'))
		{
			\lib\db\setting\update::overwirte_cat_key($access_token, 'instagram', 'access_token');
		}

		if($user_id = \dash\request::input_body('user_id'))
		{
			\lib\db\setting\update::overwirte_cat_key($user_id, 'instagram', 'user_id');
		}

		\dash\notif::ok(T_("Setting saved"));

		\content_b1\tools::say([]);
	}

}
?>