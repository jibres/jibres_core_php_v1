<?php
namespace content_v2\android;


class view
{
	public static function config()
	{
		$result =
		[
			'namespace' => 'jibres',
			'title'     => T_('Jibres'),
			'desc'      => \dash\data::site_desc(),
			'slogan'    => \dash\data::site_slogan(),
			'logo'      =>
			[
				'standard'      => \dash\url::logo(),
				'vertical'      => \dash\url::logo(),
				'icon'      => \dash\url::icon(),
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