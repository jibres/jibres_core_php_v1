<?php
namespace content_site\footer;


class f3
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
			'title'        => T_("Shopping Footer"),
			'default'      => [],
			'options'      =>
			[
				'heading_business_header',
				'description_business',

				'file_business_logo_footer',
				'menu_1',
				'menu_2',
				'menu_3',
				'menu_4',
				'description_footer',
				'certificate_enamad',
				'certificate_samandehi',
				'responsive' => \content_site\utility::set_responsive_option_footer(),

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