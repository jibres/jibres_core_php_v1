<?php
namespace content_r10\android;


class view
{
	public static function config()
	{
		$result =
		[
			'namespace' => 'jibres',
			'title'     => T_('Jibres'),
			'desc'      => \dash\data::site_desc(),
			'slogan'    => \dash\face::slogan(),
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
				'update'     => \content_r10\get::endpoint('android'). 'update',
			],
			'url'      =>
			[
				'update'   => \content_r10\get::endpoint('android/update'),
				'language' => \content_r10\get::endpoint('android/language'),
				'splash'   => \content_r10\get::endpoint('android/splash'),
				'intro'    => \content_r10\get::endpoint('android/intro'),
				'menu'     => \content_r10\get::endpoint('android/menu'),
				'ad'       => \content_r10\get::endpoint('android/ad'),
				'homepage' => \content_r10\get::homepage('my'),
			]
		];

		\dash\notif::api($result);
	}
}
?>