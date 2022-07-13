<?php
namespace content_site\body\text;


class t1
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
			'title'        => T_('Text box'),
			'options'      =>
			[
				'heading_raw',
				'text',

				// sub page
				'style' => \content_site\utility::set_style_option(
				[
					'font',
					'background_pack',
					'color_text',
				]),
				'spacing' =>
				[
					'height',
					'padding_top',
					'padding_bottom',
					'container_gallery_g4',
				],
				'responsive' =>
				[
					'responsive_device',
				],
			],
			'default'      =>
			[

			],
			'preview_list' =>
			[
				'p1',
				'p2',
			],
		];
	}


	/**
	 * Preview 1
	 */



	/**
	 * Auto Generate Function
	 * @date 2022-07-13 19:12:42
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/text/t1.php
	 * body / text / t1 / p1
	 *
	*/
	public static function p1()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'use_as_heading'   => null,
				'height'           => 'sm',
				'heading_position' => null,
				'heading'          => T_("Text box"),
				'container'        => 'sm',
				'background_pack'  => 'none',
			],
		];
	}
	// path content_site/body/text/t1.php
	// body / text / t1 / p1




	/**
	 * Auto Generate Function
	 * @date 2022-07-13 19:12:42
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/text/t1.php
	 * body / text / t1 / p2
	 *
	*/
	public static function p2()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'use_as_heading'           => null,
				'height'                   => 'sm',
				'heading_position'         => null,
				'heading'                  => T_("Text box"),
				'container'                => 'sm',
				'background_pack'          => 'solid',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#8ec5fc',
				'background_gradient_from' => '#e0c3fc',
				'background_color'         => '#f2e6e3',
			],
		];
	}
	// path content_site/body/text/t1.php
	// body / text / t1 / p2

}
?>