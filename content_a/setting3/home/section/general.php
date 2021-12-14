<?php
namespace content_a\setting3\home\section;

class general
{

	public static function list()
	{
		$list = [];


		$list[] =
		[
			'option_mode' => 'input',
			'title'       => T_("Business title"),
			'desc'        => T_("This title use in your business"),
			'input'       =>
			[
				\content_a\setting3\home\view::switcher('set_title'),

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
				\content_a\setting3\home\view::switcher('set_industry'),
				[
					'type'  => 'select',
					'name'  => 'industry',
					'value' => \lib\store::detail('industry'),
					'list'  => \lib\app\store\check::industry_list(),
				],
			],
		];

		$list['address'] =
		[
			'option_mode'  => 'btn',
			'special_html' => 'address',
			'title'        => T_("Busienss address"),
			'desc'         => T_("This address will appear on your invoices."),
			'btn_link'     => \dash\url::that(). '/address',
			'btn_title'    => T_("Edit address"),

		];

		return $list;

	}


}
?>