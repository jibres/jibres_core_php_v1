<?php
namespace content_site\header;


class h_rafiei2
{

	// is private model
	public static function is_private()
	{
		return \content_site\utility::is_private_enterprise('rafiei');
	}

	/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option()
	{
		return
		[
			'title'        => T_("Rafiei Header v2"),
			'options'      =>
			[
				// 'file_business_logo_header',
				'menu_1',
				'announcement' => share::set_announcement(),
				// 'style' => \content_site\utility::set_style_option(
				// [
				// 	'font',
				// 	'container',
				// 	'background_pack',
				// 	'link_color',
				// 	'background_color_header_line',
				// ]),
				'responsive' => share::set_responsive_option_header(),
				'spacing' =>
				[
					'padding_top',
					'padding_bottom',
					// 'container',
				],
			],
			'default'      =>
			[
				// 'use_as_logo'    => 'business_logo',
				// 'use_as_heading' => 'business_heading',
				// 'link_search'    => true,
				// 'link_enter'     => true,
				// 'link_cart'      => true,
			],

			'force' =>
			[
				'container'             => 'xl',
			],

			'preview_list' =>
			[
				'p1',
			],
		];
	}


	/**
	 * Preview 1
	 */
	public static function p1()
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				// 'use_as_logo'              => 'business_logo',
				'use_as_heading'           => 'business_heading',
				// 'link_search'              => true,
				// 'link_enter'               => true,
				// 'link_cart'                => true,
			],
		];
	}


}
?>