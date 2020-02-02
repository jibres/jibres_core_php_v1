<?php
namespace content_r10\app\splash;


class view
{
	public static function config()
	{
		$result =
		[
			'logo'       => \dash\url::icon(),
			'style'      => 1,
			'title'      => T_('Jibres'),
			'desc'       => T_('Sell and Enjoy'),
			'meta'       => 'Powered by Ermile',

			'bg' =>
			[
				'from' => '#4173cc',
				'to'   => '#1da1f3',
			],

			'color' =>
			[
				'primary' => '#fff',
				'master'  => '#eee',
			],
		];

		\dash\notif::api($result);
	}
}
?>