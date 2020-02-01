<?php
namespace content_c3\app;


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
				'update'     => \content_c3\get::endpoint('app'). 'update',
			],
			'url'      =>
			[
				'update'   => \content_c3\get::endpoint('app'). 'update',
				'splash'   => \content_c3\get::endpoint('app'). 'splash',
				'intro'    => \content_c3\get::endpoint('app'). 'intro',
				'homepage' => \content_c3\get::endpoint('app'). 'homepage',
				'menu'     => \content_c3\get::endpoint('app'). 'menu',
				'ad'       => \content_c3\get::endpoint('app'). 'ad',
			]
		];

		\dash\notif::api($result);
	}
}
?>