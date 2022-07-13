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
					'background_pack',
					'color_heading',
					'radius_full',
					'coverratio',
					'effect',
					'image_mask',
					'link_color_magicbox_title',
					'link_color_magicbox_button',
				]),
				'spacing' =>
				[
					'height',
					'padding_top',
					'padding_bottom',
					'container_gallery',
					'magicbox_gap',
				],
				'responsive' =>
				[
					'responsive_device',
					'responsive_layout',
				],
			],
			'maximum_capacity' => 12,



			'default'      =>
			[
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



	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:24:59
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g1.php
	 * body / gallery / g1 / p1
	 *
	*/
	public static function p1()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
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
				'link_color'              => 'inside',
				'image_count'             => 1,
				'height'                  => 'auto',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => 'fluid',
				'background_pack'         => 'none',
			],
		];
	}
	// path content_site/body/gallery/g1.php
	// body / gallery / g1 / p1




	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:24:59
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g1.php
	 * body / gallery / g1 / p2
	 *
	*/
	public static function p2()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
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
				'link_color'              => 'inside',
				'image_count'             => 1,
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => '2xl',
				'background_pack'         => 'none',
			],
		];
	}
	// path content_site/body/gallery/g1.php
	// body / gallery / g1 / p2


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:24:59
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g1.php
	 * body / gallery / g1 / p3
	 *
	*/
	public static function p3()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                   => '3xl',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'md',
				'link_color'               => 'light',
				'key'                      => 'gallery',
				'image_mask'               => 'heart',
				'image_count'              => 1,
				'height'                   => 'auto',
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
	// path content_site/body/gallery/g1.php
	// body / gallery / g1 / p3


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:24:59
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g1.php
	 * body / gallery / g1 / p4
	 *
	*/
	public static function p4()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                  => '3xl',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'md',
				'link_color'              => 'inside',
				'image_count'             => 2,
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => '2xl',
				'background_pack'         => 'none',
			],
		];
	}
	// path content_site/body/gallery/g1.php
	// body / gallery / g1 / p4


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:25:00
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g1.php
	 * body / gallery / g1 / p5
	 *
	*/
	public static function p5()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                  => '3xl',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'md',
				'link_color'              => 'inside',
				'image_random'            => 1,
				'image_count'             => 3,
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => '2xl',
				'background_pack'         => 'none',
			],
		];
	}
	// path content_site/body/gallery/g1.php
	// body / gallery / g1 / p5


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:25:00
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g1.php
	 * body / gallery / g1 / p6
	 *
	*/
	public static function p6()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                   => '3xl',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'md',
				'link_color'               => 'light',
				'key'                      => 'gallery',
				'image_random'             => 1,
				'image_mask'               => 'hexagon',
				'image_count'              => 3,
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
	// path content_site/body/gallery/g1.php
	// body / gallery / g1 / p6


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:25:00
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g1.php
	 * body / gallery / g1 / p7
	 *
	*/
	public static function p7()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                  => 'lg',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'md',
				'link_color'              => 'light',
				'key'                     => 'gallery',
				'image_random'            => true,
				'image_mask'              => 'none',
				'image_count'             => 4,
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => '2xl',
				'background_pack'         => 'none',
			],
		];
	}
	// path content_site/body/gallery/g1.php
	// body / gallery / g1 / p7


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:25:01
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g1.php
	 * body / gallery / g1 / p8
	 *
	*/
	public static function p8()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                  => 'none',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'none',
				'link_color'              => 'inside',
				'image_random'            => true,
				'image_mask'              => 'none',
				'image_count'             => 4,
				'height'                  => 'auto',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => 'fluid',
				'background_pack'         => 'none',
			],
		];
	}
	// path content_site/body/gallery/g1.php
	// body / gallery / g1 / p8


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:25:02
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g1.php
	 * body / gallery / g1 / p9
	 *
	*/
	public static function p9()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                   => 'lg',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'md',
				'link_color'               => 'light',
				'key'                      => 'gallery',
				'image_random'             => true,
				'image_mask'               => 'none',
				'image_count'              => 5,
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
	// path content_site/body/gallery/g1.php
	// body / gallery / g1 / p9


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:25:02
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g1.php
	 * body / gallery / g1 / p10
	 *
	*/
	public static function p10()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                  => 'lg',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'md',
				'link_color'              => 'light',
				'key'                     => 'gallery',
				'image_random'            => true,
				'image_mask'              => 'none',
				'image_count'             => 6,
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => '2xl',
				'background_pack'         => 'none',
			],
		];
	}
	// path content_site/body/gallery/g1.php
	// body / gallery / g1 / p10


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:25:03
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g1.php
	 * body / gallery / g1 / p11
	 *
	*/
	public static function p11()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                  => 'lg',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'sm',
				'link_color'              => 'light',
				'key'                     => 'gallery',
				'image_random'            => true,
				'image_mask'              => 'none',
				'image_count'             => 8,
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => '2xl',
				'background_pack'         => 'none',
			],
		];
	}
	// path content_site/body/gallery/g1.php
	// body / gallery / g1 / p11


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:25:04
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g1.php
	 * body / gallery / g1 / p12
	 *
	*/
	public static function p12()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                  => 'lg',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'sm',
				'link_color'              => 'light',
				'key'                     => 'gallery',
				'image_random'            => true,
				'image_mask'              => 'none',
				'image_count'             => 10,
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => '2xl',
				'background_pack'         => 'none',
			],
		];
	}
	// path content_site/body/gallery/g1.php
	// body / gallery / g1 / p12


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:25:06
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g1.php
	 * body / gallery / g1 / p13
	 *
	*/
	public static function p13()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                  => 'lg',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'sm',
				'link_color'              => 'light',
				'key'                     => 'gallery',
				'image_random'            => true,
				'image_mask'              => 'none',
				'image_count'             => 12,
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => '2xl',
				'background_pack'         => 'none',
			],
		];
	}
	// path content_site/body/gallery/g1.php
	// body / gallery / g1 / p13

}
?>