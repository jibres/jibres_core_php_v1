<?php
namespace content_site\body\imagetext;


class imagetext1
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
				'file',
				'position',
				'text_link',
				'text' =>
				[
					'text'
				],
				// sub page
				'style' => \content_site\utility::set_style_option(
				[
					'background_pack',
					'image_mask',
					'coverratio',
					'radius_full',
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

				'background_pack' => 'none',
				'height'          => 'md',
				'coverratio'      => '16:9',
				'position'        => 'left',
				'radius'          => '3xl',

				'file'            => \dash\sample\img::background(),
				'html_text'       => T_("Your text"),



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