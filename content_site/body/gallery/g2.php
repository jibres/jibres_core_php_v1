<?php
namespace content_site\body\gallery;


class g2
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
			'title'        => T_("Gallery"). ' - '. T_("4 Magic Box + Slider"),
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
					'link_color_magicbox_title',
					'type',
				]),
			],
			'maximum_capacity' => 12,
			'default'      =>
			[
				'heading'                 => T_("Image Gallery"),
				'magicbox_title_position' => 'inside',
				'height'                  => 'auto',
				'container'               => 'fluid',
				'link_color'              => 'inside',
				'effect'                  => 'zoom',
				'image_count'             => 12,
			],
			'preview_list' =>
			[
				'p1',
				'p2',
				'p3',
				'p4',
				'p5',
				'p6',
				'p7',
				'p8',
				'p9',
				'p10',
				'p11',
				'p12',
				'p13',
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
			'preview_title'  => T_("Gallery"). ' - '. T_("Magic Line"). ' - '. T_("Sample :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[
				'image_count' => 1,
				'image_list' =>
				[
					[
						'file'  => \dash\url::cdn().'/img/sitebuilder/gallery/g1/bg-3.jpg',
						'title' => T_('Image 1'),
					],
				],
				'radius'                  => 'none',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'md',
				'height'                  => 'auto',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => 'fluid',
				'background_pack'         => 'none',

			],
		];
	}


	public static function p2()
	{
		return
		[
			'preview_title'  => T_("Gallery"). ' - '. T_("Magic Line"). ' - '. T_("Sample :val", ['val' => \dash\fit::number(2)]),
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
				'radius'                  => '3xl',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'md',
				'height'                  => 's',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => '2xl',
				'background_pack'         => 'none',

			],
		];
	}


}
?>