<?php
namespace content_api\v1\account\smile;


class controller
{
	public static function routing()
	{
		\content_api\v1::invalid_url();
	}

	public static function api_routing()
	{
		if(\dash\url::dir(4))
		{
			\content_api\v1::invalid_url();
		}

		\content_api\v1::apikey_required();

		if(!\dash\request::is('get'))
		{
			\content_api\v1::invalid_method();
		}

		$smile = self::smile();

		\content_api\v1::say($smile);
	}


	private static function smile()
	{
		$smile     = [];


		$id = \dash\user::id();

		if(!$id)
		{
			return false;
		}

		$notif_count = \dash\app\log::my_notif_count($id);

		$smile =
		[
			'notif_new'   => $notif_count ? true : false,
			'notif_count' => $notif_count,
		];

		return $smile;
	}
}
?>