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


		$list['a123'] =
		[
			'icon'         => \dash\utility\icon::svg('123', 'bootstrap'),
			'title'        => T_("Security"),
			'link'         => \dash\url::this(). '/a123',
			'special_html' => 'test',
		];


		$list['app'] =
		[
			'icon'  => \dash\utility\icon::svg('app', 'bootstrap'),
			'title' => T_("Application"),
			'link'  => \dash\url::this(). '/app',
		];

		return $list;
	}
}
?>