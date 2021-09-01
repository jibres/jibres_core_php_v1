<?php
namespace content_site\footer\f3;


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
			'title'        => T_("Card Design"),
			'default'      => [],
			'options'      =>
			[
				'heading_business_footer',
				'file_business_logo_header',
				'menu_1',
				// 'style' =>
				// [
					// 'type',
				// ]

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