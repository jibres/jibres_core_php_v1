<?php
namespace content_v2\account\smile;


class controller
{
	public static function routing()
	{
		\content_v2\tools::invalid_url();
	}

	public static function api_routing()
	{
		if(\dash\url::dir(4))
		{
			\content_v2\tools::invalid_url();
		}

		\content_v2\tools::apikey_required();

		if(!\dash\request::is('get'))
		{
			\content_v2\tools::invalid_method();
		}

		$smile = self::smile();

		\content_v2\tools::say($smile);
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