<?php
namespace content_v2\android\splash;


class view
{
	public static function config()
	{

		$detail = \lib\app\application\detail::get_android();
		$logo   = isset($detail['logo']) ? $detail['logo'] : \dash\url::cdn(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png';
		$theme  = isset($detail['theme']) ? $detail['theme'] : 'store1';
		$title  = isset($detail['title']) ? $detail['title'] : T_('Jibres');
		$desc   = isset($detail['desc']) ? $detail['desc'] : T_('Sell and Enjoy');
		$slogan = isset($detail['slogan']) ? $detail['slogan'] : T_('Powered by Jibres');

		$result =
		[
			'logo'  => $logo,
			'theme' => $theme,
			'title' => $title,
			'desc'  => $slogan,
			// 'meta'  => $desc,
			'sleep' => 3000,

			'bg' =>
			[
				'from' => '#36D1DC',
				'to'   => '#5B86E5',
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