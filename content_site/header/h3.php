<?php
namespace content_site\header;


class h3
{

	/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option()
	{
		return
		[
			'title'        => T_("Shopping Header"),
			'options'      =>
			[
				'heading_business_header',
				'file_business_logo_header',
				'menu_1',
				'menu_2',
				'link_search',
				'link_cart',
				'link_enter',
				'announcement' => share::set_announcement(),
				'style' => \content_site\utility::set_style_option(
				[
					// 'font',
					'container',
				]),
				'responsive' => share::set_responsive_option_header(),

			],
			'default'      =>
			[
				'use_as_logo'    => 'business_logo',
				'use_as_heading' => 'business_heading',
				'link_search'    => true,
				'link_enter'     => true,
				'link_cart'      => true,
				'container'      => 'xl',
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
				'use_as_logo'    => 'business_logo',
				'use_as_heading' => 'business_heading',
				'link_search'    => true,
				'link_enter'     => true,
				'link_cart'      => true,
				'container'      => 'xl',
			],
		];
	}


}
?>