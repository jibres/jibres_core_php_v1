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
	public static function p1($_title = null)
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'heading'          => T_("Text box"),
				'use_as_heading'   => null,
				'height'           => 'sm',
				'heading_position' => null,
				'container'        => 'sm',
				'background_pack'  => 'none',
			],
		];
	}


	public static function p2($_title = null)
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'heading'                  => T_("Text box"),
				'use_as_heading'           => null,
				'height'                   => 'sm',
				'heading_position'         => null,
				'container'                => 'sm',
				'background_pack'          => 'solid',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#8ec5fc',
				'background_gradient_from' => '#e0c3fc',
				'background_color'         => '#f2e6e3',
			],
		];
	}

}
?>