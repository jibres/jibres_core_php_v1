<?php
namespace content_v2\android\intro;


class view
{
	public static function config()
	{
		$page = \lib\app\application\intro::get();

		$theme = isset($page['theme']) ? $page['theme'] : null;
		$page = array_values($page);


		$from = '#c80a5a';
		$to   = '#c80a5a';

		switch ($theme)
		{
			case 'theme1':
			case 'theme2':
			case 'theme3':
			case 'theme4':
			case 'theme5':
				$from = '#c'. rand(10, 99).'a5a';
				$to   = '#c'. rand(10, 99).'a5a';
				break;

			default:
				// nothing
				break;
		}

		$result =
		[
			'page' => $page,

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
				'from' => $from,
				'to'   => $to,
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
		// 	'logo'  => \dash\url::cdn(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
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