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
			'option_mode' => 'input',
			'title'       => T_("Business title"),
			'desc'        => T_("This title use in your business"),
			'input'       =>
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
			'option_mode' => 'input',
			'title'       => T_("Business industry"),
			'desc'        => T_("About your industry"),
			'input'       =>
			[
				[
					'type'  => 'hidden',
					'name'  => 'set_industry',
					'value' => 'set_industry',
				],
				[
					'type'  => 'select',
					'name'  => 'industry',
					'value' => \lib\store::detail('industry'),
					'list'  => \lib\app\store\check::industry_list(),
				],
			],
		];

		$list[] =
		[
			'option_mode' => 'btn',
			'title'       => T_("Busienss address"),
			'desc'        => T_("This address will appear on your invoices."),
			'btn_link'    => \dash\url::that(). '/address',
			'btn_title'   => T_("Edit address"),

		];


		\dash\data::settingOptions($list);

	}


}
?>