<?php
namespace content_r10\android\splash;


class view
{
	public static function config()
	{
		$result =
		[
			'logo'  => \dash\url::static(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
			'theme' => 'Jibres',
			'title' => T_('Jibres'),
			'desc'  => T_('Sell and Enjoy'),
			'meta'  => 'Powered by Ermile',

			'bg' =>
			[
				'from' => '#c80a5a',
				'to'   => '#c80a5a',
			],

			'color' =>
			[
				'primary'   => '#fff',
				'secondary' => '#eee',
			],
		];

		\dash\notif::api($result);
	}
}
?>