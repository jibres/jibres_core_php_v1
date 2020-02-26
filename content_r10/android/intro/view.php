<?php
namespace content_r10\android\intro;


class view
{
	public static function config()
	{
		$result =
		[
			'page' =>
			[
				[
					'title' => T_('Hello'),
					'desc'  => T_('Welcome to Jibres world'),
					'image' => \dash\url::cdn(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
				],
				[
					'subtitle' => T_('Sell and Enjoy'),
					'desc'  => T_('All-in-one ecommerce platform'),
					// 'image'  => \dash\url::cdn(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
				],
				[
					// 'subtitle' => T_('Sell and Enjoy'),
					'desc'  => T_('All-in-one ecommerce platform'),
					// 'image'  => \dash\url::cdn(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
				],
				[
					'title' => T_('Jibres'),
					// 'desc'  => T_('Jibres'),
					// 'image'  => \dash\url::cdn(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
				],
				[
					'subtitle' => T_('Sometimes you need a big change.'),
					// 'desc'  => T_('Jibres'),
					'image'  => \dash\url::cdn(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
				],
				[
					// 'subtitle' => T_('Sometimes you need a big change.'),
					// 'desc'  => T_('Jibres'),
					'image'  => \dash\url::cdn(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
				],
				[
					// 'title' => T_('Sometimes you need a big change.'),
					// 'desc'  => T_('Jibres'),
					// 'image'  => \dash\url::cdn(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
				],
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
				'from'       => '#c80a5a',
				'to'         => '#c80a5a',
				'dot'        => '#dddddd',
				'doSelected' => '#ffffff',
			],
			'color' =>
			[
				'primary'   => '#ffffff',
				'secondary' => '#eeeeee',
			],
		];

		\dash\notif::api($result);
	}
}
?>