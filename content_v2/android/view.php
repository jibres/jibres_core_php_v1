<?php
namespace content_v2\android;


class view
{
	public static function config()
	{
		$load_app_detail = \lib\app\application\detail::get_android();

		$result =
		[
			'namespace' => 'jibres',
			'title'     => isset($load_app_detail['title']) ? $load_app_detail['title'] : T_('Jibres'),
			'desc'      => \dash\data::site_desc(),
			'slogan'    => \dash\data::site_slogan(),
			'logo'      =>
			[
				'standard' => isset($load_app_detail['logo']) ? $load_app_detail['logo'] : \dash\url::logo(),
				'vertical' => \dash\url::logo(),
				'icon'     => \dash\url::icon(),
			],
			'version'   =>
			[
				'last'       => 4,
				'depricated' => 3,
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