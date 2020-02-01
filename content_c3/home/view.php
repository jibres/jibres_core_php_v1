<?php
namespace content_c3\home;


class view
{
	public static function config()
	{
		$result =
		[
			'en' =>
			[
				'website'   => 'https://jibres.com',
				'endpoint'  => 'https://core.jibres.com/c3',
				'doc'       => 'https://core.jibres.com/c3/doc',
				'direction' => 'ltr',
				'lang'      => 'English',
				'langname'  => 'English',
			],
			'fa' =>
			[
				'website'   => 'https://jibres.ir',
				'endpoint'  => 'https://core.jibres.ir/c3',
				'doc'       => 'https://core.jibres.ir/c3/doc',
				'direction' => 'rtl',
				'lang'      => 'Persian',
				'langname' => 'فارسی',
			],
		];

		\dash\notif::api($result);
	}
}
?>