<?php
namespace content_v2\user\detail;


class view
{
	public static function config()
	{
		$user_code = \dash\request::get('id');

		$detail = \dash\app\user::get($user_code);

		if(is_array($detail))
		{
			$detail = \content_v2\user\fetch\view::ready($detail);
		}

		\content_v2\tools::say($detail);
	}
}
?>