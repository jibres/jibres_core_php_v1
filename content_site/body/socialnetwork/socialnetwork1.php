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
				'socialnetwork_size',


				// sub page
				'style' => \content_site\utility::set_style_option(
				[
					'font',
					'background_pack',
					'justify_heading',
					'heading_size',
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
				'responsive' =>
				[
					'responsive_device',
				],
			],
			'default'      =>
			[
				'heading'               => T_("Social Networks"),
				'post_template'         => 'any',
				'post_order'            => 'latest',
				'count'                 => 3,
				'use_as_socialnetwork' => 'business_socialnetwork',


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



	/**
	 * Auto Generate Function
	 * @date 2022-07-13 19:17:40
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/socialnetwork/socialnetwork1.php
	 * body / socialnetwork / socialnetwork1 / p1
	 *
	*/
	public static function p1()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'use_as_socialnetwork' => 'business_socialnetwork',
				'radius_normal'        => 'none',
				'radius'               => 'full',
				'height'               => 'md',
				'heading_position'     => 'center',
				'heading'              => T_("Social Networks"),
				'coverratio'           => '16:9',
				'count'                => 3,
				'color_text'           => '#333333',
				'background_pack'      => 'none',
			],
		];
	}
	// path content_site/body/socialnetwork/socialnetwork1.php
	// body / socialnetwork / socialnetwork1 / p1

}
?>