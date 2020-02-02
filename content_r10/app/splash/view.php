<?php
namespace content_r10\app\splash;


class view
{
	public static function config()
	{
		$result =
		[
			'logo'  => \dash\url::static(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png',
			'style' => 1,
			'title' => T_('Jibres'),
			'desc'  => T_('Sell and Enjoy'),
			'meta'  => 'Powered by Ermile',

			'bg' =>
			[
				'from' => '#4173cc',
				'to'   => '#1da1f3',
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