<?php
namespace content_a\setting2\general;

class view extends \content_a\setting2\home\view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'));

		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::include_m2('wide');


		self::setting_category();

		self::general_setting();

	}


	private static function general_setting()
	{
		$list = [];


		$list[] =
		[
			'mode' => 'btn',
			'title' => T_("General"),
			'desc' => T_("Description"),
			'btn_link'  => \dash\url::this(). '/btn',
			'btn_title' => T_("General"),

		];


		$list[] =
		[
			'mode' => 'btn',
			'title' => T_("General"),
			'desc' => T_("Description"),
			'btn_link'  => \dash\url::this(). '/btn',
			'btn_title' => T_("General"),

		];



		\dash\data::settingOptions($list);

	}


}
?>