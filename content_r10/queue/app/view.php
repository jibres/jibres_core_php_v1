<?php
namespace content_r10\queue\app;


class view
{
	public static function config()
	{
		$result =
		[
			'store' => 'y88p',
		];

		\dash\notif::api($result);
	}
}
?>