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
				'image_list' =>
				[
					'file_gallery',
					'caption_gallery',
					'link_gallery',
					'target_gallery',
					'image_remove',
				],
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
					'height',
					'background_pack',
					'container_gallery',
					'magicbox_gap',
					'radius_full',
					'coverratio_no_free',
					'effect',
					'image_mask',
					'link_color_magicbox_title',
				]),
			],
			'break_image_list' => 4,
			'maximum_capacity' => 14,
			'minimum_item'     => 6,
			'default'          =>
			[
				'heading'                 => T_("Image Gallery"),
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

			],
		];
	}
}
?>