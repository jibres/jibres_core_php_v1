<?php
namespace content_site\body\application;


class enterpriseRafiei
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
			'title'        => T_("application Rafiei"),
			'options'      =>
			[
				'heading_business',
				'description_business',
				'file_business_logo',
				'android_apk_link',
				'link_googleplay',
				'link_cafebazar',
				'link_myket',

				'style' => \content_site\utility::set_style_option(
				[
					'font',

					'radius_full',
					'background_pack',
					'color_heading',
					'color_text',
				]),
				'spacing' =>
				[
					'height',
					'padding_top',
					'padding_bottom',
					'container',
				],
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