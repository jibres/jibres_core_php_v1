<?php
namespace content_v2\android;


class view
{
	public static function config()
	{
		$load_app_detail = \lib\app\application\detail::get_android();

		$result =
		[
			'namespace' => 'com.jibres.'. \dash\url::store(),
			'title'     => isset($load_app_detail['title']) ? $load_app_detail['title'] : T_('Jibres'),
			'desc'      => isset($load_app_detail['desc']) ? $load_app_detail['desc'] : \dash\data::site_desc(),
			'slogan'    => isset($load_app_detail['slogan']) ? $load_app_detail['slogan'] : \dash\data::site_slogan(),
			'logo'      =>
			[
				'standard' => \dash\url::logo(),
				'vertical' => \dash\url::logo(),
				'icon'     => isset($load_app_detail['logo']) ? $load_app_detail['logo'] : \dash\url::icon(),
			],
			'version'   =>
			[
				'last'       => \lib\app\application\version::get_last_version(),
				'depricated' => \lib\app\application\version::get_depricated_version(),
				'update'     => \content_v2\get::endpoint('android'). '/update',
			],
			'url'      =>
			[
				'update'   => \content_v2\get::endpoint('android'). '/update',
				'language' => \content_v2\get::endpoint('android'). '/language',
				'splash'   => \content_v2\get::endpoint('android'). '/splash',
				'intro'    => \content_v2\get::endpoint('android'). '/intro',
				'homepage' => \content_v2\get::endpoint('android'). '/homepage',
				'menu'     => \content_v2\get::endpoint('android'). '/menu',
				'ad'       => \content_v2\get::endpoint('android'). '/ad',
			]
		];

		\dash\notif::api($result);
	}
}
?>