<?php
namespace content_site\body\gallery;


class g4
{
		/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option()
	{
		$option                           = g2::option();
		$option['title']                  = T_("Slider");

		$option['maximum_capacity']       = 14;
		$option['minimum_item']           = 1;
		$option['default']['image_count'] = 12;
		unset($option['break_image_list']);

		$myKey = array_search('slider_effect', $option['options']['slider_setting']);
		$option['options']['slider_setting'] = array_replace($option['options']['slider_setting'], [$myKey => 'slider_effect_full']);

		$myKey = array_search('container_gallery', $option['options']['style']);
		$option['options']['style'] = array_replace($option['options']['style'], [$myKey => 'container_gallery_g4']);


		$option['preview_list']           =
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
		];

		return $option;

	}






	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:26:16
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g4.php
	 * body / gallery / g4 / p1
	 *
	*/
	public static function p1()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_pagination'       => true,
				'slider_next_prev'        => true,
				'slider_effect'           => 'slide',
				'slider_autoplay'         => 5,
				'radius'                  => 'lg',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'sm',
				'link_color'              => 'light',
				'image_random'            => true,
				'image_count'             => 5,
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => '16:9',
				'container'               => 'xl',
				'background_pack'         => 'none',
				'background_color'        => '#8ea4c8',
			],
		];
	}
	// path content_site/body/gallery/g4.php
	// body / gallery / g4 / p1




	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:26:21
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g4.php
	 * body / gallery / g4 / p2
	 *
	*/
	public static function p2()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_pagination'       => true,
				'slider_next_prev'        => true,
				'slider_effect'           => 'coverflow',
				'slider_autoplay'         => 5,
				'radius'                  => '3xl',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'sm',
				'link_color'              => 'light',
				'image_random'            => true,
				'image_count'             => 5,
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => '16:9',
				'container'               => 'lg',
				'background_pack'         => 'none',
				'background_color'        => '#8ea4c8',
			],
		];
	}
	// path content_site/body/gallery/g4.php
	// body / gallery / g4 / p2


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:26:25
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g4.php
	 * body / gallery / g4 / p3
	 *
	*/
	public static function p3()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_pagination'        => true,
				'slider_next_prev'         => true,
				'slider_effect'            => 'cards',
				'slider_autoplay'          => 5,
				'radius'                   => 'lg',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'sm',
				'link_color'               => 'light',
				'image_random'             => true,
				'image_count'              => 5,
				'height'                   => 'sm',
				'effect'                   => 'zoom',
				'coverratio'               => '16:9',
				'container'                => 'md',
				'background_pack'          => 'none',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#a7b168',
				'background_gradient_from' => '#cc0fa2',
				'background_color'         => '#8ea4c8',
			],
		];
	}
	// path content_site/body/gallery/g4.php
	// body / gallery / g4 / p3


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:26:31
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g4.php
	 * body / gallery / g4 / p4
	 *
	*/
	public static function p4()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_pagination'        => true,
				'slider_next_prev'         => true,
				'slider_effect'            => 'cube',
				'slider_autoplay'          => 5,
				'radius'                   => 'lg',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'sm',
				'link_color'               => 'light',
				'image_random'             => true,
				'image_count'              => 5,
				'height'                   => 'md',
				'effect'                   => 'dark',
				'coverratio'               => '3:1',
				'container'                => 'md',
				'background_pack'          => 'none',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#a7b168',
				'background_gradient_from' => '#cc0fa2',
				'background_color'         => '#8ea4c8',
			],
		];
	}
	// path content_site/body/gallery/g4.php
	// body / gallery / g4 / p4


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:26:35
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g4.php
	 * body / gallery / g4 / p5
	 *
	*/
	public static function p5()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_pagination'        => true,
				'slider_next_prev'         => true,
				'slider_effect'            => 'fade',
				'slider_autoplay'          => 5,
				'radius'                   => '3xl',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'sm',
				'link_color'               => 'light',
				'image_random'             => true,
				'image_count'              => 5,
				'height'                   => 'md',
				'effect'                   => 'dark',
				'coverratio'               => '1:1',
				'container'                => 'sm',
				'background_pack'          => 'none',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#a7b168',
				'background_gradient_from' => '#cc0fa2',
				'background_color'         => '#8ea4c8',
			],
		];
	}
	// path content_site/body/gallery/g4.php
	// body / gallery / g4 / p5


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:26:39
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g4.php
	 * body / gallery / g4 / p6
	 *
	*/
	public static function p6()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_pagination'        => true,
				'slider_next_prev'         => true,
				'slider_effect'            => 'fade',
				'slider_autoplay'          => 5,
				'radius'                   => '3xl',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'sm',
				'link_color'               => 'light',
				'image_random'             => true,
				'image_mask'               => 'squircle',
				'image_count'              => 5,
				'height'                   => 'md',
				'effect'                   => 'dark',
				'coverratio'               => '1:1',
				'container'                => 'sm',
				'background_pack'          => 'solid',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#a7b168',
				'background_gradient_from' => '#cc0fa2',
				'background_color'         => '#9c9359',
			],
		];
	}
	// path content_site/body/gallery/g4.php
	// body / gallery / g4 / p6


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:26:45
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g4.php
	 * body / gallery / g4 / p7
	 *
	*/
	public static function p7()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_pagination'        => false,
				'slider_next_prev'         => false,
				'slider_effect'            => 'fade',
				'slider_autoplay'          => 5,
				'radius'                   => '3xl',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'sm',
				'link_color'               => 'light',
				'image_random'             => true,
				'image_mask'               => 'heart',
				'image_count'              => 5,
				'height'                   => 'md',
				'effect'                   => 'dark',
				'coverratio'               => '1:1',
				'container'                => 'md',
				'background_pack'          => 'solid',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#a7b168',
				'background_gradient_from' => '#cc0fa2',
				'background_color'         => '#9c9359',
			],
		];
	}
	// path content_site/body/gallery/g4.php
	// body / gallery / g4 / p7


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:26:50
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g4.php
	 * body / gallery / g4 / p8
	 *
	*/
	public static function p8()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_pagination'        => false,
				'slider_next_prev'         => false,
				'slider_effect'            => 'fade',
				'slider_autoplay'          => 5,
				'radius'                   => '3xl',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'sm',
				'link_color'               => 'light',
				'image_random'             => true,
				'image_mask'               => 'star-2',
				'image_count'              => 5,
				'height'                   => 'sm',
				'effect'                   => 'dark',
				'coverratio'               => '1:1',
				'container'                => 'sm',
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#e2ebf0',
				'background_gradient_from' => '#cfd9df',
				'background_color'         => '#9c9359',
			],
		];
	}
	// path content_site/body/gallery/g4.php
	// body / gallery / g4 / p8


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:26:55
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g4.php
	 * body / gallery / g4 / p9
	 *
	*/
	public static function p9()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_pagination'        => true,
				'slider_next_prev'         => true,
				'slider_effect'            => 'coverflow',
				'slider_autoplay'          => 5,
				'radius'                   => '3xl',
				'magicbox_title_position'  => 'inside',
				'magicbox_gap'             => 'sm',
				'link_color'               => 'light',
				'image_random'             => true,
				'image_mask'               => 'none',
				'image_count'              => 5,
				'height'                   => 'sm',
				'effect'                   => 'dark',
				'coverratio'               => '3:1',
				'container'                => 'lg',
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#e2ebf0',
				'background_gradient_from' => '#cfd9df',
				'background_color'         => '#9c9359',
			],
		];
	}
	// path content_site/body/gallery/g4.php
	// body / gallery / g4 / p9


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:27:00
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g4.php
	 * body / gallery / g4 / p10
	 *
	*/
	public static function p10()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_pagination'        => true,
				'slider_next_prev'         => true,
				'slider_effect'            => 'slide',
				'slider_autoplay'          => 5,
				'radius'                   => 'none',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'none',
				'link_color'               => 'light',
				'image_random'             => true,
				'image_mask'               => 'none',
				'image_count'              => 5,
				'height'                   => 'auto',
				'effect'                   => 'none',
				'coverratio'               => '3:1',
				'container'                => 'fluid',
				'background_pack'          => 'none',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#e2ebf0',
				'background_gradient_from' => '#cfd9df',
				'background_color'         => '#9c9359',
			],
		];
	}
	// path content_site/body/gallery/g4.php
	// body / gallery / g4 / p10

}
?>