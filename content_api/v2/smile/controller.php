<?php
namespace content_api\v2\smile;


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

		\content_api\v2::check_apikey();

		$smile = self::smile();

		\content_api\v2::say($smile);
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