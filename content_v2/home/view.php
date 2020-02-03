<?php
namespace content_v2\home;


class view
{
	public static function config()
	{
		$result =
		[
			'en' =>
			[
				'website'   => 'https://jibres.com',
				'endpoint'  => 'https://api.jibres.com/v2',
				'doc'       => 'https://api.jibres.com/v2/doc',
				'direction' => 'ltr',
				'lang'      => 'English',
				'langname'  => 'English',
			],
			'fa' =>
			[
				'website'   => 'https://jibres.ir',
				'endpoint'  => 'https://api.jibres.ir/v2',
				'doc'       => 'https://api.jibres.ir/v2/doc',
				'direction' => 'rtl',
				'lang'      => 'Persian',
				'langname' => 'فارسی',
			],
		];

		\dash\notif::api($result);
	}
}
?>