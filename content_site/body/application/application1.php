<?php
namespace content_site\body\application;


class application1
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
			'title'        => T_("application 1"),
			'options'      =>
			[
				'heading_business',
				'description_business',
				'file_business_logo',
				'link_googleplay',
				'link_cafebazar',
				'link_myket',

				'style' => \content_site\utility::set_style_option(
				[
					'font',

					'height',
					'radius_full',
					'background_pack',

				]),
				'responsive' => \content_site\utility::set_responsive_option(),
			],
			'default'      =>
			[
				'heading'              => T_("Application"),
				'height'               => 'fullscreen',
				'use_as_heading'       => 'business_heading',
				'use_as_description'   => 'business_description',
				'background_pack'      => 'solid',
				'background_color'     => '#eeeeee',
			],
			'preview_list' =>
			[
				'p1',
				'p2'
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
				'radius'               => 'full',

			],
		];
	}



}
?>