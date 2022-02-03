<?php
namespace content_a\setting3\home;

class category
{


	/**
	 * Make setting category array
	 */
	public static function setting_category()
	{
		$list = [];


		$list['general'] =
		[
			'icon'  => \dash\utility\icon::svg('gear', 'bootstrap'),
			'title' => T_("General"),
			'link'  => \dash\url::this(). '/general',
		];

		$list['security'] =
		[
			'icon'         => \dash\utility\icon::svg('shield-lock', 'bootstrap'),
			'title'        => T_("Security"),
			'link'         => \dash\url::this(). '/security',
		];

		$list['other'] =
		[
			'icon'         => \dash\utility\icon::svg('app', 'bootstrap'),
			'title'        => T_("Other"),
			'link'         => \dash\url::this(). '/other',
		];

		return $list;
	}
}
?>