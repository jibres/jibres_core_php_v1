<?php
namespace content_site\body\title;


class title1
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
			'title'        => T_("Title 1"),
			'options'      =>
			[
				'heading',
				'padding',
				'responsive' => \content_site\utility::set_responsive_option(),
			],
			'default'      =>
			[
				'heading' => T_("Title"),
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