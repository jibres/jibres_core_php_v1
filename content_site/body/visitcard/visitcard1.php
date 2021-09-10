<?php
namespace content_site\body\visitcard;


class visitcard1
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
			'title'        => T_("visitcard 1"),
			'options'      =>
			[
				'heading_business',
				'description_business',
				'file_business_logo',

				'socialnetwork',

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
				'heading'              => T_("Visit card"),
				'height'               => 'fullscreen',
				'use_as_socialnetwork' => 'business_socialnetwork',
				'use_as_logo'          => 'business_logo',
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