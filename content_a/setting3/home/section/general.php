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

		$logo_src = \lib\store::logo();
		if(\lib\store::detail('default_logo'))
		{
			$logo_src = null;
		}

		$switcher_remove_logo = \content_a\setting3\home\view::switcher('remove_logo', 'array');
		$remove_logo_json     = array_merge($switcher_remove_logo, ["remove_business_logo" => "logo"]);
		$remove_logo_json     = json_encode($remove_logo_json);

		\dash\allow::file();

		$logo =
		[
			'option_mode' => 'file',
			'title'       => T_("Business logo"),
			'desc'        => T_("Description"),

			'footer1' =>
			[
				[
				],
			],

			'footer2' =>
			[
				[
					'btn_html' => "<div data-confirm data-data='$remove_logo_json' class='link-danger'>". T_("Remove logo"). '</div>',
				]
			],

			'input'       =>
			[
				\content_a\setting3\home\view::switcher('set_logo'),
				[
					'type'  => 'file',
					'name'  => 'logo',
					'value' => $logo_src,
				],
			],
		];

		if(\lib\store::detail('default_logo'))
		{
			unset($logo['footer2']);
		}

		$list[] = $logo;



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