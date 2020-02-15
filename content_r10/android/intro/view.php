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
					'image' => \dash\url::static(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
					'next'  => T_('Next'),
					// 'prev'  => T_('Skip'),
				],
				[
					'title' => T_('Sell and Enjoy'),
					'desc'  => T_('All-in-one ecommerce platform'),
					// 'image'  => \dash\url::static(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
					'next'  => T_('Next'),
					'prev'  => T_('Prev'),
				],
				[
					'title' => T_('Sometimes you need a big change.'),
					// 'desc'  => T_('Jibres'),
					'image'  => \dash\url::static(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
					'next'  => T_('Continue'),
					'prev'  => T_('Prev'),
				],
				[
					// 'title' => T_('Sometimes you need a big change.'),
					// 'desc'  => T_('Jibres'),
					// 'image'  => \dash\url::static(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
					// 'next'  => T_('Next'),
					'prev'  => T_('Prev'),
				],
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
	}
}
?>