<?php
namespace content_site\body\gallery;


class g1
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
			'title'        => T_("Magic Gallery box"),
			'default'      => option::master_default(['type' => 'g1', 'effect' => 'zoom', ]),
			'options'      =>
			[
				'heading_raw',
				'image_list' =>
				[
					'file_gallery',
					'caption_gallery',
					'link_gallery',
					'target_gallery',
					'remove_gallery',
				],
				'image_add',

				'magicbox_title_position',
				'image_random',
				// sub page
				'style' => \content_site\options\style::option_list(
				[
					'font',
					'height',
					'container_gallery',
					'magicbox_gap',
					'background_pack',
					'color_heading',
					'radius_full',
					'coverratio',
					'effect',
					'image_mask',
					'link_color',
					'type',
				]),
			],
			'preview_list' =>
			[
				'p1',
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
			'preview_title'  => T_("Card"),
			'version'        => 1,
		];
	}



	public static function maximum_capacity()
	{
		return 12;
	}


}
?>