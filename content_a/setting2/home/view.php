<?php
namespace content_a\setting2\home;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'));

		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::include_m2('wide');


		self::setting_category();

	}


	public static function setting_category()
	{
		$list = [];


		$list['general'] =
		[
			'icon'  => \dash\utility\icon::svg('gear', 'bootstrap'),
			'title' => T_("General"),
			'link'  => \dash\url::this(). '/general',
		];


		$list['123'] =
		[
			'icon'  => \dash\utility\icon::svg('123', 'bootstrap'),
			'title' => T_("Security"),
			'link'  => \dash\url::this(). '/122',
		];


		$list['app'] =
		[
			'icon'  => \dash\utility\icon::svg('app', 'bootstrap'),
			'title' => T_("Application"),
			'link'  => \dash\url::this(). '/app',
		];

		\dash\data::settingCategory($list);
	}
}
?>