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
			'options'      =>
			[
				// 'heading_raw',
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
			'maximum_capacity' => 12,
			'default'      =>
			[
				'heading'     => T_("Image Gallery"),
				'magicbox_title_position' => 'inside',
				'type'        => 'g1',
				'height'      => 'auto',
				'container'   => 'fluid',
				'effect'      => 'zoom',
				'image_count' => 12,
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
			'options' =>
			[
				'image_count' => 1,
				'image_list' =>
				[
					[
						'file'  => \dash\url::cdn().'/img/sitebuilder/gallery/g1/bg-3.jpg',
						'title' => 'Image 1',
					],
				],
				'type'                    => 'g1',
				'preview_key'             => 'p1',
				'magicbox_title_position' => 'hide',
				'link_color'              => 'light',
				'key'                     => 'gallery',
				'image_count'             => 1,
				'height'                  => 'auto',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => 'fluid',

			],
		];
	}


}
?>