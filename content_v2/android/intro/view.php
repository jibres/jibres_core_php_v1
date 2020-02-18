<?php
namespace content_v2\android\intro;


class view
{
	public static function config()
	{
		$page = \lib\app\application\intro::get();
		$page = array_values($page);

		$result =
		[
			'page' =>
			[
				$page,
			],
			'translation' =>
			[
				'next'  => T_('Next'),
				'prev'  => T_('Prev'),
				'skip'  => T_('Skip'),
				'start' => T_('Get Start'),
			],
			'theme' => 'Jibres',
			'bg' =>
			[
				'from' => '#c80a5a',
				'to'   => '#c80a5a',
			],
			'color' =>
			[
				'primary'   => '#ffffff',
				'secondary' => '#eeeeee',
			],
		];

		\dash\notif::api($result);

		// $result =
		// [
		// 	'logo'  => \dash\url::static(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
		// 	'theme' => 'Jibres',
		// 	'title' => T_('Jibres'),
		// 	'desc'  => T_('Sell and Enjoy'),
		// 	'meta'  => 'Powered by Ermile',

		// 	'bg' =>
		// 	[
		// 		'from' => '#4173cc',
		// 		'to'   => '#1da1f3',
		// 	],

		// 	'color' =>
		// 	[
		// 		'primary'   => '#fff',
		// 		'secondary' => '#eee',
		// 	],
		// ];

		// \dash\notif::api($result);
	}
}
?>