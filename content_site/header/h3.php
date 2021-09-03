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
			'default'      => [],
			'options'      =>
			[
				'heading_business_header',
				'file_business_logo_header',
				'menu_1',
				'menu_2',
				'link_search',
				'link_cart',
				'link_enter',
				'responsive' => \content_site\utility::set_responsive_option_header(),

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

			],
		];
	}


}
?>