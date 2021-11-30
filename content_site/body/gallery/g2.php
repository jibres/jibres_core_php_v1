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
			'title'        => T_("4 Magic Box + Slider"),
			'options'      =>
			[
				// 'heading_raw',
				'image_list' => option::option_in_one_item(),

				'image_add',

				'magicbox_title_position_slider',
				'image_random',

				'slider_setting' =>
				[
					'slider_effect',
					'slider_autoplay',
					'slider_next_prev',
					'slider_pagination',
				],

				// sub page
				'style' => \content_site\utility::set_style_option(
				[
					'font',
					'background_pack',
					'radius_full',
					'coverratio_no_free',
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
			'break_image_list' => 4,
			'maximum_capacity' => 14,
			'minimum_item'     => 5,
			'default'          =>
			[
				'magicbox_title_position' => 'inside',
				'coverratio'              => '16:9',
				'height'                  => 'auto',
				'container'               => 'fluid',
				'link_color'              => 'inside',
				'effect'                  => 'zoom',
				'slider_effect'           => 'slide',
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
				'image_count'             => 7,
				'slider_pagination'       => true,
				'slider_next_prev'        => true,
				'slider_effect'           => 'slide',
				'slider_autoplay'         => 5,
				'radius'                  => 'lg',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'sm',
				'link_color'              => 'light',
				'image_random'            => true,
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => '16:9',
				'container'               => 'xl',
				'background_pack'         => 'none',
				'background_color'        => '#8ea4c8',
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
				'image_count'             => 7,
				'slider_pagination'       => true,
				'slider_next_prev'        => true,
				'slider_effect'           => 'coverflow',
				'slider_autoplay'         => 5,
				'radius'                  => '3xl',
				'magicbox_title_position' => 'inside',
				'magicbox_gap'            => 'sm',
				'link_color'              => 'light',
				'image_random'            => true,
				'height'                  => 'sm',
				'effect'                  => 'dark',
				'coverratio'              => '1:1',
				'container'               => 'xl',
				'background_pack'         => 'none',
				'background_color'        => '#c3b8aa',
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
				'image_count'             => 7,
				'slider_pagination'       => true,
				'slider_next_prev'        => false,
				'slider_effect'           => 'fade',
				'slider_autoplay'         => 5,
				'radius'                  => 'none',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'sm',
				'link_color'              => 'light',
				'image_random'            => true,
				'height'                  => 'md',
				'effect'                  => 'zoom',
				'coverratio'              => '3:1',
				'container'               => 'xl',
				'background_pack'         => 'none',
				'background_color'        => '#c3b8aa',
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
				'image_count'             => 7,
				'slider_pagination'       => true,
				'slider_next_prev'        => true,
				'slider_effect'           => 'coverflow',
				'slider_autoplay'         => 5,
				'radius'                  => 'lg',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'sm',
				'link_color'              => 'light',
				'image_random'            => true,
				'height'                  => 'sm',
				'effect'                  => 'light',
				'coverratio'              => '3:4',
				'container'               => 'xl',
				'background_pack'         => 'none',
				'background_color'        => '#c3b8aa',
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
				'image_count'             => 7,
				'slider_pagination'       => true,
				'slider_next_prev'        => false,
				'slider_effect'           => 'fade',
				'slider_autoplay'         => 5,
				'radius'                  => 'none',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'none',
				'link_color'              => 'light',
				'image_random'            => true,
				'image_mask'              => 'none',
				'height'                  => 'sm',
				'effect'                  => 'dark',
				'coverratio'              => '16:9',
				'container'               => 'xl',
				'background_pack'         => 'none',
				'background_color'        => '#c3b8aa',
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
				'image_count'             => 7,
				'slider_pagination'       => true,
				'slider_next_prev'        => true,
				'slider_effect'           => 'slide',
				'slider_autoplay'         => 5,
				'radius'                  => 'lg',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'sm',
				'link_color'              => 'light',
				'image_random'            => true,
				'image_mask'              => 'none',
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => '16:9',
				'container'               => 'xl',
				'background_pack'         => 'solid',
				'background_color'        => '#a2c4c6',
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
				'image_count'              => 7,
				'slider_pagination'        => true,
				'slider_next_prev'         => true,
				'slider_effect'            => 'cube',
				'slider_autoplay'          => 5,
				'radius'                   => 'lg',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'sm',
				'link_color'               => 'light',
				'image_random'             => true,
				'image_mask'               => 'none',
				'height'                   => 'md',
				'effect'                   => 'none',
				'coverratio'               => '1:1',
				'container'                => 'xl',
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#ffd1ff',
				'background_gradient_from' => '#fad0c4',
				'background_color'         => '#a2c4c6',
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
				'image_count'              => 7,
				'slider_pagination'        => true,
				'slider_next_prev'         => false,
				'slider_effect'            => 'fade',
				'slider_autoplay'          => 5,
				'radius'                   => 'full',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'sm',
				'link_color'               => 'light',
				'image_random'             => true,
				'image_mask'               => 'none',
				'height'                   => 'sm',
				'effect'                   => 'none',
				'coverratio'               => '1:1',
				'container'                => 'xl',
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#8ec5fc',
				'background_gradient_from' => '#e0c3fc',
				'background_color'         => '#a2c4c6',
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
				'image_count'              => 7,
				'slider_pagination'        => true,
				'slider_next_prev'         => false,
				'slider_effect'            => 'fade',
				'slider_autoplay'          => 5,
				'radius'                   => 'normal',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'sm',
				'link_color'               => 'light',
				'image_random'             => true,
				'image_mask'               => 'parallelogram-4',
				'height'                   => 'md',
				'effect'                   => 'none',
				'coverratio'               => '1:1',
				'container'                => 'xl',
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#c75856',
				'background_gradient_from' => '#e09dd4',
				'background_color'         => '#a2c4c6',
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
				'image_count'              => 7,
				'slider_pagination'        => false,
				'slider_next_prev'         => true,
				'slider_effect'            => 'fade',
				'slider_autoplay'          => 5,
				'radius'                   => 'normal',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'sm',
				'link_color'               => 'light',
				'image_random'             => true,
				'image_mask'               => 'hexagon-2',
				'height'                   => 'md',
				'effect'                   => 'none',
				'coverratio'               => '1:1',
				'container'                => 'xl',
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#ebedee',
				'background_gradient_from' => '#fdfbfb',
				'background_color'         => '#7b92aa',
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
				'image_count'              => 7,
				'slider_pagination'        => false,
				'slider_next_prev'         => false,
				'slider_effect'            => 'fade',
				'slider_autoplay'          => 5,
				'radius'                   => 'normal',
				'magicbox_title_position'  => 'hide',
				'magicbox_gap'             => 'sm',
				'link_color'               => 'light',
				'image_random'             => true,
				'image_mask'               => 'heart',
				'height'                   => 'md',
				'effect'                   => 'none',
				'coverratio'               => '1:1',
				'container'                => 'xl',
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#ffd1ff',
				'background_gradient_from' => '#fad0c4',
				'background_color'         => '#7b92aa',
			],
		];
	}
}
?>