<?php
namespace content_a\setting2\home;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'));

		// remove sidebar
		\dash\data::include_m2('wide');

		// set back link
		self::set_back_btn();

		// load setting category
		self::setting_category();

	}


	/**
	 * Detect url and set back link
	 */
	private static function set_back_btn()
	{
		if(\dash\url::subchild())
		{
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::that());
		}
		elseif(\dash\url::child())
		{
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());
		}
		else
		{
			\dash\data::back_text(T_('Dashboard'));
			\dash\data::back_link(\dash\url::here());
		}
	}



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