<?php
namespace content_site\body\formbuilder;


class formbuilder1
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
			'title'        => null,
			'options'      =>
			[
				'formbuilder',
				// sub page
				'style' => \content_site\utility::set_style_option(
				[
					'background_pack',
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



	/**
	 * Auto Generate Function
	 * @date 2022-07-13 19:02:21
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/formbuilder/formbuilder1.php
	 * body / formbuilder / formbuilder1 / p1
	 *
	*/
	public static function p1()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius_normal'    => 'none',
				'radius'           => 'full',
				'height'           => 'md',
				'heading_position' => 'center',
				'coverratio'       => '16:9',
				'count'            => 3,
				'color_text'       => '#333333',
				'background_pack'  => 'none',
			],
		];
	}
	// path content_site/body/formbuilder/formbuilder1.php
	// body / formbuilder / formbuilder1 / p1
}
?>