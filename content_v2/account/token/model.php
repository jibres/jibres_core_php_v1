<?php
namespace content_v2\account\token;


class model
{

	public static function post()
	{
		$parent = null;
		if(isset(\content_v2\tools::$v2['appkey_detail']['id']))
		{
			$parent = \content_v2\tools::$v2['appkey_detail']['id'];
		}

		$result = \dash\app\user_auth::make(['parent' => $parent]);

		\content_v2\tools::say($result);
	}
}
?>