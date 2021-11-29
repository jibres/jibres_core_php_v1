<?php
namespace content_site\body\twitter;


class twitter1
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
			'title'        => T_("Twitter"),
			'options'      =>
			[
				'heading',

				'twitter',
				'twitter_theme',
				'twitter_size',
				'twitter_darkmode',


				// sub page
				'style' => \content_site\utility::set_style_option(
				[
					'font',
					'background_pack',
					'justify_heading',
					'heading_size',
					'color_heading',
					'radius_normal',

				]),
				'spacing' =>
				[
					'height',
					'padding_top',
					'padding_bottom',
					'container',
				],
				'responsive' =>
				[
					'responsive_device',
				],
			],
			'default'      =>
			[
				'heading'               => T_("Twitter"),

				'count'                 => 1,


				'background_pack'       => 'none',
				'height'                => 'md',
				'coverratio'            => '16:9',
				'color_text'            => '#333333',
				'heading_position'      => 'center',

				'radius'         => 'normal',
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

			],
		];
	}



}
?>