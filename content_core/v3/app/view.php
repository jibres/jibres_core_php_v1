<?php
namespace content_core\v3\app;


class view
{
	public static function config()
	{
		$result =
		[
			'en' =>
			[
				'namespace'   => \dash\data::endpoint(),
				'website'   => 'https://jibres.com',
				'endpoint'  => 'https://core.jibres.com/v3',
				'doc'       => 'https://core.jibres.com/v3/doc',
				'direction' => 'ltr',
				'lang'      => 'English',
				'langname'  => 'English',
			],
			'fa' =>
			[
				'namespace'   => 'jibres',
				'website'   => 'https://jibres.ir',
				'endpoint'  => 'https://core.jibres.ir/v3',
				'doc'       => 'https://core.jibres.ir/v3/doc',
				'direction' => 'rtl',
				'lang'      => 'Persian',
				'langname' => 'فارسی',
			],
		];

		\dash\notif::api($result);
	}
}
?>