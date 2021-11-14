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
			'title'        => T_("Magic Line"),
			'options'      =>
			[
				// 'heading_raw',
				'image_list' => option::option_in_one_item(),

				'image_add',

				'magicbox_title_position',
				'image_random',
				// sub page
				'style' => \content_site\utility::set_style_option(
				[
					'font',
					'height',
					'background_pack',
					'container_gallery',
					'magicbox_gap',
					'color_heading',
					'radius_full',
					'coverratio',
					'effect',
					'image_mask',
					'link_color_magicbox_title',
				]),
				'responsive' => \content_site\utility::set_responsive_option(),
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
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => '2xl',
				'background_pack'         => 'none',

			],
		];
	}


	public static function p3()
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'image_count'              => 1,
				'radius'                   => '3xl',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'md',
				'link_color'               => 'light',
				'key'                      => 'gallery',
				'image_mask'               => 'heart',
				'height'                   => 'fullscreen',
				'effect'                   => 'zoom',
				'coverratio'               => 'free',
				'container'                => 'lg',
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#000000',
				'background_gradient_from' => '#434343',
				'background_color'         => '#ddf2f4',
			],
		];
	}


	public static function p4()
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'image_count'             => 2,
				'radius'                  => '3xl',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'md',
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => '2xl',
				'background_pack'         => 'none',


			],
		];
	}


	public static function p5()
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'image_count'             => 3,
				'radius'                  => '3xl',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'md',
				'image_random'            => 1,
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => '2xl',
				'background_pack'         => 'none',
			],
		];
	}


	public static function p6()
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'image_count'              => 3,
				'radius'                   => '3xl',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'md',
				'link_color'               => 'light',
				'key'                      => 'gallery',
				'image_random'             => 1,
				'image_mask'               => 'hexagon',
				'height'                   => 'sm',
				'effect'                   => 'dark',
				'coverratio'               => '1:1',
				'container'                => '2xl',
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#fda085',
				'background_gradient_from' => '#f6d365',
				'background_color'         => '#a9c8c0',
			],
		];
	}


	public static function p7()
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'image_count'              => 4,
				'radius'                   => 'lg',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'md',
				'link_color'               => 'light',
				'key'                      => 'gallery',
				'image_random'             => true,
				'image_mask'               => 'none',
				'height'                   => 'sm',
				'effect'                   => 'zoom',
				'coverratio'               => 'free',
				'container'                => '2xl',
				'background_pack'          => 'none',
			],
		];
	}


	public static function p8()
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'image_count'             => 4,
				'radius'                  => 'none',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'none',
				'image_random'            => true,
				'image_mask'              => 'none',
				'height'                  => 'auto',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => 'fluid',
				'background_pack'         => 'none',
			],
		];
	}


	public static function p9()
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'image_count'              => 5,
				'radius'                   => 'lg',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'md',
				'link_color'               => 'light',
				'key'                      => 'gallery',
				'image_random'             => true,
				'image_mask'               => 'none',
				'height'                   => 'sm',
				'effect'                   => 'zoom',
				'coverratio'               => 'free',
				'container'                => '2xl',
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#e2ebf0',
				'background_gradient_from' => '#cfd9df',
				'background_color'         => '#c6ac85',
			],
		];
	}


	public static function p10()
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'image_count'              => 6,
				'radius'                   => 'lg',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'md',
				'link_color'               => 'light',
				'key'                      => 'gallery',
				'image_random'             => true,
				'image_mask'               => 'none',
				'height'                   => 'sm',
				'effect'                   => 'zoom',
				'coverratio'               => 'free',
				'container'                => '2xl',
				'background_pack'          => 'none',
			],
		];
	}


	public static function p11()
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'image_count'              => 8,
				'radius'                   => 'lg',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'sm',
				'link_color'               => 'light',
				'key'                      => 'gallery',
				'image_random'             => true,
				'image_mask'               => 'none',
				'height'                   => 'sm',
				'effect'                   => 'zoom',
				'coverratio'               => 'free',
				'container'                => '2xl',
				'background_pack'          => 'none',
			],
		];
	}


	public static function p12()
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'image_count'              => 10,
				'radius'                   => 'lg',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'sm',
				'link_color'               => 'light',
				'key'                      => 'gallery',
				'image_random'             => true,
				'image_mask'               => 'none',
				'height'                   => 'sm',
				'effect'                   => 'zoom',
				'coverratio'               => 'free',
				'container'                => '2xl',
				'background_pack'          => 'none',
			],
		];
	}


	public static function p13()
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'image_count'              => 12,
				'radius'                   => 'lg',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'sm',
				'link_color'               => 'light',
				'key'                      => 'gallery',
				'image_random'             => true,
				'image_mask'               => 'none',
				'height'                   => 'sm',
				'effect'                   => 'zoom',
				'coverratio'               => 'free',
				'container'                => '2xl',
				'background_pack'          => 'none',
			],
		];
	}
}
?>