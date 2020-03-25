<?php
namespace content_v2\android\splash;


class view
{
	public static function config()
	{

		$detail             = \lib\app\application\detail::get_android();

		$logo               = isset($detail['logo']) ? $detail['logo'] : \dash\url::cdn(). '/logo/icon-white/png/Jibres-Logo-icon-white-1024.png';
		$theme              = isset($detail['splash_theme']) ? $detail['splash_theme'] : 'store1';

		$start_splash_color = (isset($detail['splash_theme']['start'])) ? $detail['splash_theme']['start'] : '#121317';
		$end_splash_color   = (isset($detail['splash_theme']['end'])) ? $detail['splash_theme']['end'] : '#323B42';
		$text_splash_color  = (isset($detail['splash_theme']['text_color'])) ? $detail['splash_theme']['text_color'] : '#ffffff';
		$meta_splash_color  = (isset($detail['splash_theme']['meta_color'])) ? $detail['splash_theme']['meta_color'] : '#eeeeee';

		$title              = isset($detail['title']) ? $detail['title'] : T_('Jibres');
		$desc               = isset($detail['desc']) ? $detail['desc'] : T_('Sell and Enjoy');
		$slogan             = isset($detail['slogan']) ? $detail['slogan'] : T_('Powered by Jibres');

		$result =
		[
			'logo'  => $logo,
			'theme' => 'store1',
			'title' => $title,
			'desc'  => $slogan,
			// 'meta'  => $desc,
			'sleep' => 3000,

			'bg' =>
			[
				'from' => $start_splash_color,
				'to'   => $end_splash_color,
			],

			'color' =>
			[
				'primary'   => $text_splash_color,
				'secondary' => $meta_splash_color,
			],
		];

		\content_v2\tools::say($result);


	}
}
?>