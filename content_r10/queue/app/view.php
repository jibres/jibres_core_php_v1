<?php
namespace content_r10\queue\app;


class view
{
	public static function config()
	{
		$result = \lib\app\application\queue::get_build_queue();

		$result =
		[
			'store' => 'y88p',
		];

		\dash\notif::api($result);
	}
}
?>