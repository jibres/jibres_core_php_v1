<?php
namespace content_v2\account\smile;


class view
{

	public static function config()
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

		\content_v2\tools::say($smile);

	}
}
?>