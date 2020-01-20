<?php
namespace content_core\v3\home;


class controller
{
	public static function routing()
	{
		$result =
		[
			'en' =>
			[
				'website'  => 'https://jibres.com',
				'endpoint' => 'https://core.jibres.com/v3',
				'doc'      => 'https://core.jibres.com/v3/doc',
			],
			'fa' =>
			[
				'website'  => 'https://jibres.ir',
				'endpoint' => 'https://core.jibres.ir/v3',
				'doc'      => 'https://core.jibres.ir/v3/doc',
			],
		];

		\dash\notif::api($result);
	}
}
?>