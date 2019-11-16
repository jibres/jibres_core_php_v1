<?php
namespace content_api\v2\token;


class controller
{
	public static function routing()
	{
		\content_api\v2::invalid_url();
	}

	public static function api_routing()
	{
		if(\dash\url::subchild())
		{
			\content_api\v2::invalid_url();
		}

		\content_api\v2::check_appkey();

		\content_api\v2::check_store_init();

		$parent = null;
		if(isset(\content_api\v2::$v2['appkey_detail']['id']))
		{
			$parent = \content_api\v2::$v2['appkey_detail']['id'];
		}

		$result = \dash\app\user_auth::make(['parent' => $parent]);

		\content_api\v2::say($result);
	}
}
?>