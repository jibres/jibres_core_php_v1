<?php
namespace content_site\footer;


class f1
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
			'title'        => T_("Simple"),
			'default'      => [],
			'options'      =>
			[
				'heading_business_header',
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