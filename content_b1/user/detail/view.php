<?php
namespace content_b1\user\detail;


class view
{
	public static function config()
	{
		$user_code = \dash\request::get('id');

		$detail = \dash\app\user::get($user_code);

		if(is_array($detail))
		{
			$detail = \content_b1\user\fetch\view::ready($detail);
		}

		\content_b1\tools::say($detail);
	}
}
?>