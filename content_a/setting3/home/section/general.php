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
					'btn_html' => "<div data-confirm data-data='$remove_logo_json' class='link-danger my-1'>". T_("Remove logo"). '</div>',
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


		$address =
		[
			'title'        => T_("Busienss address"),
			'desc'         => T_("This address will appear on your invoices."),
			'option_mode'  => 'btn',
			'special_html' => 'address',
			'btn_link'     => \dash\url::that(). '/address',
			'btn_title'    => T_("Edit address"),

		];

		$current_address = '';
		$temp_address = \lib\store::detail();
		$temp_address = a($temp_address, 'store_data');

		if(a($temp_address, 'country_detail', 'name'))
		{
			$current_address .= '<div class="mB5">'. T_("Country"). ' '. '<b>'. a($temp_address, 'country_detail', 'name') .'</b></div>';
		};

        if(a($temp_address, 'province_detail', 'name'))
        {
        	$current_address .= '<div class="mB5">'. T_("Province"). ' '. '<b>'. a($temp_address, 'province_detail', 'name') .'</b></div>';
        };

        if(a($temp_address, 'city_detail', 'name'))
        {
        	$current_address .= '<div class="mB5">'. T_("City"). ' '. '<b>'. a($temp_address, 'city_detail', 'name') .'</b></div>';
        };

        if(a($temp_address, 'postcode'))
        {
        	$current_address .= '<div class="mB5">'. T_("Postcode"). ' '. '<b>'. \dash\fit::text(a($temp_address, 'postcode')) .'</b></div>';
        };

        if(a($temp_address, 'phone'))
        {
        	$current_address .= '<div class="mB5">'. T_("Phone"). ' '. '<b>'. \dash\fit::text(a($temp_address, 'phone')) .'</b></div>';
        };

        if(a($temp_address, 'address'))
        {
        	$current_address .= '<div class="mB5">'. a($temp_address, 'address') .'</div>';
        };


        $address['html'] = $current_address;

        $list['address'] = $address;


		$list[] =
		[
			'option_mode' => 'input',
			'title'       => T_("Business currency"),
			'desc'        => T_("Description"),
			'input'       =>
			[
				\content_a\setting3\home\view::switcher('set_currency'),
				[
					'type'  => 'select',
					'name'  => 'currency',
					'value' => \lib\store::detail('currency'),
					'list'  => \lib\currency::list_pretty(),
				],
			],
		];



		$list[] =
		[
			'option_mode' => 'input',
			'title'       => T_("Weight Unit"),
			'desc'        => T_("Description"),
			'input'       =>
			[
				\content_a\setting3\home\view::switcher('set_mass'),
				[
					'type'  => 'select',
					'name'  => 'mass_unit',
					'value' => \lib\store::detail('mass_unit'),
					'list'  => \lib\units::list_pretty('mass'),
				],
			],
		];


		$list[] =
		[
			'option_mode' => 'input',
			'title'       => T_("Dimensions Unit"),
			'desc'        => T_("Description"),
			'input'       =>
			[
				\content_a\setting3\home\view::switcher('set_length'),
				[
					'type'  => 'select',
					'name'  => 'length_unit',
					'value' => \lib\store::detail('length_unit'),
					'list'  => \lib\units::list_pretty('length'),
				],
			],
		];



		$list[] =
		[
			'option_mode' => 'input',
			'title'       => T_("Dimensions language"),
			'desc'        => T_("Description"),
			'input'       =>
			[
				\content_a\setting3\home\view::switcher('set_lang'),
				[
					'type'  => 'select',
					'name'  => 'lang',
					'value' => \lib\store::detail('lang'),
					'list'  => \dash\language::all(true),
				],
			],
		];



		return $list;

	}


}
?>