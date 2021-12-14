<?php
namespace content_a\setting2\general;

class view extends \content_a\setting2\home\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Setting'));

		self::general_setting();

	}


	private static function general_setting()
	{
		$list = [];


		$list[] =
		[
			'mode' => 'input',
			'title' => T_("Business title"),
			'desc' => T_("This title use in your business"),
			'input'  =>
			[
				[
					'type'  => 'hidden',
					'name'  => 'set_title',
					'value' => 'set_title',
				],
				[
					'type'        => 'text',
					'name'        => 'title',
					'value'       => \lib\store::title(),
					// 'placeholder' => 'Title',
				],
			],
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