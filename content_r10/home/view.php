<?php
namespace content_r10\home;


class view
{
	public static function config()
	{
		$result =
		[
			'en' =>
			[
				'website'   => 'https://jibres.com',
				'endpoint'  => 'https://core.jibres.com/r10',
				'doc'       => 'https://core.jibres.com/r10/doc',
				'direction' => 'ltr',
				'lang'      => 'English',
				'langname'  => 'English',
			],
			'fa' =>
			[
				'website'   => 'https://jibres.ir',
				'endpoint'  => 'https://core.jibres.ir/r10',
				'doc'       => 'https://core.jibres.ir/r10/doc',
				'direction' => 'rtl',
				'lang'      => 'Persian',
				'langname' => 'فارسی',
			],
		];

		\content_r10\tools::say($result);
	}
}
?>