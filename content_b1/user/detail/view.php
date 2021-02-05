<?php
namespace content_b1\user\detail;


class view
{
	public static function config()
	{
		\dash\permission::access('_group_crm');

		$user_code = \dash\request::get('id');

		$detail = \dash\app\user::get($user_code);

		if(is_array($detail))
		{
			$detail = \dash\app\user::ready_api($detail);
		}

		\content_b1\tools::say($detail);
	}
}
?>