<?php
namespace content_api\v6\token;


class controller
{
	public static function routing()
	{
		if(\dash\url::subchild())
		{
			\content_api\v6::invalid_url();
		}

		\content_api\v6::check_appkey();

		\content_api\v6::check_store_init();

		$parent = null;
		if(isset(\content_api\v6::$v6['appkey_detail']['id']))
		{
			$parent = \content_api\v6::$v6['appkey_detail']['id'];
		}

		$result = \dash\app\user_auth::make(['parent' => $parent]);

		\content_api\v6::say($result);
	}
}
?>