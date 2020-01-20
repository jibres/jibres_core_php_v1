<?php
namespace content_core\home;


class controller
{
	public static function routing()
	{
		$result =
		[
			'last-version' =>
			[
				'url' => \dash\url::kingdom(). '/v3',
				'doc' => \dash\url::kingdom(). '/v3/doc',
			],
		];

		\dash\notif::api($result);
	}
}
?>