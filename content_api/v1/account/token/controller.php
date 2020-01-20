<?php
namespace content_api\v1\account\token;


class controller
{
	public static function routing()
	{
		\content_api\v1\tools::invalid_url();
	}

	public static function api_routing()
	{
		if(\dash\url::dir(4))
		{
			\content_api\v1\tools::invalid_url();
		}

		if(!\dash\request::is('post'))
		{
			\content_api\v1\tools::invalid_method();
		}

		$parent = null;
		if(isset(\content_api\v1\tools::$v1['appkey_detail']['id']))
		{
			$parent = \content_api\v1\tools::$v1['appkey_detail']['id'];
		}

		$result = \dash\app\user_auth::make(['parent' => $parent]);

		\content_api\v1\tools::say($result);
	}
}
?>