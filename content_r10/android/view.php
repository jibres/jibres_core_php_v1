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
			'desc'      => \dash\face::intro(),
			'slogan'    => \dash\face::slogan(),
			'logo'      =>
			[
				'standard' => \dash\url::cdn(). '/logo/en/png/Jibres-Logo-en-safe-2048.png',
				'vertical' => \dash\url::cdn(). '/logo/en-vertical/png/Jibres-Logo-en-vertical-2048.png',
				'icon'     => \dash\url::cdn(). '/logo/icon/png/Jibres-Logo-icon-2048.png',
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

		\content_r10\tools::say($result);
	}
}
?>