<?php
namespace content_site\body\socialnetwork;


class socialnetwork1
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
			'title'        => T_("Social Networks"),
			'options'      =>
			[
				'heading',

				'socialnetwork',


				// sub page
				'style' => \content_site\utility::set_style_option(
				[
					'heading_justify',
					'heading_size',
					'font',
					'background_pack',
					'color_heading',
					'radius_normal',
					'coverratio',
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
				'heading'               => T_("Social Networks"),
				'post_template'         => 'any',
				'post_order'            => 'latest',
				'count'                 => 3,



				'background_pack'       => 'none',
				'height'                => 'md',
				'coverratio'            => '16:9',
				'color_text'            => '#333333',
				'heading_position'      => 'center',

				'radius_normal'         => 'none',
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