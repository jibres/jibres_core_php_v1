<?php
namespace content_site\body\gallery;


class g5
{

	/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option()
	{

		$option                           = g2::option();
		$option['title']                  = T_("Magic Box");

		$option['maximum_capacity']       = 14;
		$option['minimum_item']           = 1;
		$option['default']['image_count'] = 12;
		unset($option['break_image_list']);
		unset($option['options']['slider_setting']);

		// $myKey = array_search('slider_effect', $option['options']['slider_setting']);
		// $option['options']['slider_setting'] = array_replace($option['options']['slider_setting'], [$myKey => 'slider_effect_full']);

		$myKey = array_search('container_gallery', $option['options']['style']);
		$option['options']['style'] = array_replace($option['options']['style'], [$myKey => 'container_gallery_g4']);


		$option['preview_list'] =
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
	 * Preview 1
	 */



	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:46:18
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g5.php
	 * body / gallery / g5 / p1
	 *
	*/
	public static function p1()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_effect'             => 'slide',
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_count'               => 12,
				'height'                    => 'auto',
				'effect'                    => 'dark',
				'coverratio'                => '16:9',
				'count'                     => 12,
				'container'                 => 'fluid',
				'color_text'                => '#333333',
				'background_pack'           => 'none',
			],
		];
	}
	// path content_site/body/gallery/g5.php
	// body / gallery / g5 / p1




	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:46:28
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g5.php
	 * body / gallery / g5 / p2
	 *
	*/
	public static function p2()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_effect'             => 'slide',
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'image_count'               => 12,
				'height'                    => 'auto',
				'effect'                    => 'dark',
				'coverratio'                => '3:1',
				'count'                     => 10,
				'container'                 => 'fluid',
				'color_text'                => '#333333',
				'background_pack'           => 'solid',
				'background_color'          => '#e5faff',
			],
		];
	}
	// path content_site/body/gallery/g5.php
	// body / gallery / g5 / p2


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:46:36
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g5.php
	 * body / gallery / g5 / p3
	 *
	*/
	public static function p3()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_effect'             => 'slide',
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'image_count'               => 12,
				'height'                    => 'auto',
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'count'                     => 8,
				'container'                 => 'fluid',
				'color_text'                => '#333333',
				'background_pack'           => 'solid',
				'background_color'          => '#dcdbd9',
			],
		];
	}
	// path content_site/body/gallery/g5.php
	// body / gallery / g5 / p3


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:46:46
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g5.php
	 * body / gallery / g5 / p4
	 *
	*/
	public static function p4()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_effect'             => 'slide',
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'image_count'               => 12,
				'height'                    => 'auto',
				'effect'                    => 'dark',
				'coverratio'                => '3:4',
				'count'                     => 4,
				'container'                 => 'fluid',
				'color_text'                => '#333333',
				'background_pack'           => 'gradient',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#c4c2d0',
				'background_gradient_from'  => '#bce2e6',
				'background_color'          => '#dcdbd9',
			],
		];
	}
	// path content_site/body/gallery/g5.php
	// body / gallery / g5 / p4


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:46:57
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g5.php
	 * body / gallery / g5 / p5
	 *
	*/
	public static function p5()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_effect'             => 'slide',
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'outside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'image_count'               => 12,
				'height'                    => 'auto',
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'count'                     => 4,
				'container'                 => 'fluid',
				'color_text'                => '#333333',
				'background_pack'           => 'solid',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#1663a9',
				'background_gradient_from'  => '#0ff53b',
				'background_color'          => '#000000',
			],
		];
	}
	// path content_site/body/gallery/g5.php
	// body / gallery / g5 / p5


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:47:06
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g5.php
	 * body / gallery / g5 / p6
	 *
	*/
	public static function p6()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_effect'             => 'slide',
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'squircle',
				'image_count'               => 12,
				'height'                    => 'auto',
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'count'                     => 8,
				'container'                 => 'fluid',
				'color_text'                => '#333333',
				'background_pack'           => 'solid',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#1663a9',
				'background_gradient_from'  => '#0ff53b',
				'background_color'          => '#f4c815',
			],
		];
	}
	// path content_site/body/gallery/g5.php
	// body / gallery / g5 / p6


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:47:19
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g5.php
	 * body / gallery / g5 / p7
	 *
	*/
	public static function p7()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_effect'             => 'slide',
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'hide',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'heart',
				'image_count'               => 12,
				'height'                    => 'auto',
				'effect'                    => 'light',
				'coverratio'                => '1:1',
				'count'                     => 1,
				'container'                 => 'fluid',
				'color_text'                => '#333333',
				'background_pack'           => 'solid',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#1663a9',
				'background_gradient_from'  => '#0ff53b',
				'background_color'          => '#ffc0cb',
			],
		];
	}
	// path content_site/body/gallery/g5.php
	// body / gallery / g5 / p7


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:47:29
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g5.php
	 * body / gallery / g5 / p8
	 *
	*/
	public static function p8()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_effect'             => 'slide',
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'outside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'hexagon-2',
				'image_count'               => 3,
				'height'                    => 'auto',
				'effect'                    => 'none',
				'coverratio'                => '1:1',
				'count'                     => 3,
				'container'                 => 'fluid',
				'color_text'                => '#333333',
				'background_pack'           => 'solid',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#1663a9',
				'background_gradient_from'  => '#0ff53b',
				'background_color'          => '#8fa2a6',
			],
		];
	}
	// path content_site/body/gallery/g5.php
	// body / gallery / g5 / p8


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:47:39
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g5.php
	 * body / gallery / g5 / p9
	 *
	*/
	public static function p9()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_effect'             => 'slide',
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'hide',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'parallelogram',
				'image_count'               => 12,
				'height'                    => 'auto',
				'effect'                    => 'none',
				'coverratio'                => '1:1',
				'count'                     => 3,
				'container'                 => 'fluid',
				'color_text'                => '#333333',
				'background_pack'           => 'gradient',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#e6a691',
				'background_gradient_from'  => '#915118',
				'background_color'          => '#8fa2a6',
			],
		];
	}
	// path content_site/body/gallery/g5.php
	// body / gallery / g5 / p9


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:47:51
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g5.php
	 * body / gallery / g5 / p10
	 *
	*/
	public static function p10()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'slider_effect'             => 'slide',
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'outside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'parallelogram-4',
				'image_count'               => 12,
				'height'                    => 'auto',
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'count'                     => 4,
				'container'                 => 'fluid',
				'color_text'                => '#333333',
				'background_pack'           => 'gradient',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#674c4b',
				'background_gradient_from'  => '#1f1004',
				'background_color'          => '#8fa2a6',
			],
		];
	}
	// path content_site/body/gallery/g5.php
	// body / gallery / g5 / p10
}
?>