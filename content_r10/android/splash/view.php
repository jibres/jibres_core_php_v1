<?php
namespace content_r10\android\splash;


class view
{
	public static function config()
	{
		$result =
		[
			'logo'  => \dash\url::cdn(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
			'theme' => 'Jibres',
			'title' => T_('Jibres'),
			'desc'  => T_('Sell and Enjoy'),
			'meta'  => 'Powered by Ermile',
			'sleep' => 3000,

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