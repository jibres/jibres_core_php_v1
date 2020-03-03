<?php
namespace content_v2\home;


class view
{
	public static function config()
	{
		$myStore = \dash\url::store();
		if($myStore)
		{
			$myStore = $myStore . '/';
		}

		$result =
		[
			'en' =>
			[
				'website'   => 'https://jibres.com',
				'endpoint'  => 'https://api.jibres.com/'. $myStore. 'v2',
				'doc'       => 'https://api.jibres.com/'. $myStore. 'v2/doc',
				'direction' => 'ltr',
				'lang'      => 'English',
				'langname'  => 'English',
			],
			'fa' =>
			[
				'website'   => 'https://jibres.ir',
				'endpoint'  => 'https://api.jibres.ir/'. $myStore. 'v2',
				'doc'       => 'https://api.jibres.ir/'. $myStore. 'v2/doc',
				'direction' => 'rtl',
				'lang'      => 'Persian',
				'langname' => 'فارسی',
			],
		];

		\dash\notif::api($result);
	}
}
?>