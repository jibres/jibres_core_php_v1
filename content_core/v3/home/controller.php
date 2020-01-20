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
				'direction' => 'ltr',
				'name'    => 'English',
				'localname' => 'English',
			],
			'fa' =>
			[
				'website'  => 'https://jibres.ir',
				'endpoint' => 'https://core.jibres.ir/v3',
				'doc'      => 'https://core.jibres.ir/v3/doc',
				'direction' => 'rtl',
				'name'    => 'Persian',
				'localname' => 'فارسی',
			],
		];

		\dash\notif::api($result);
	}
}
?>