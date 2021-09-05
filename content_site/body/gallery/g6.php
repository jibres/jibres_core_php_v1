<?php
namespace content_site\body\gallery;


class g6
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
			'title'        => T_("Card Slider"),
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

				// 'magicbox_title_position_slider',
				'image_random',

				'slider_setting' =>
				[
					'slider_effect',
					'slider_autoplay',
					'slider_next_prev',
					'slider_pagination',
					'slider_size',
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
					// 'link_color_magicbox_title',
				]),
				'responsive' => \content_site\utility::set_responsive_option(),
			],
			// 'break_image_list' => 4,
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
				// 'p2',
				// 'p3',
				// 'p4',
				// 'p5',
				// 'p6',
				// 'p7',
				// 'p8',
				// 'p9',
				// 'p10',
				// 'p11',
			],
		];


	}


	/**
	 * Preview 1
	 */
	public static function p1($_title = null)
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'inside',
				'post_show_image'           => true,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'height'                    => 'fullscreen',
				'effect'                    => 'dark',
				'coverratio'                => '16:9',
				'magicbox_gap'              => 'sm',
				'count'                     => 12,
				'color_text'                => '#333333',
				'background_pack'           => 'none',
			]
		];
	}


	public static function p2($_title = null)
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'inside',
				'post_show_image'           => true,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'height'                    => 'fullscreen',
				'effect'                    => 'dark',
				'coverratio'                => '3:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 10,
				'color_text'                => '#333333',
				'background_pack'           => 'solid',
				'background_color'          => '#e5faff',
			]
		];
	}


	public static function p3($_title = null)
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'inside',
				'post_show_image'           => true,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'height'                    => 'fullscreen',
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 8,
				'color_text'                => '#333333',
				'background_pack'           => 'solid',
				'background_color'          => '#dcdbd9',
			]
		];
	}


	public static function p4($_title = null)
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'inside',
				'post_show_image'           => true,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'height'                    => 'fullscreen',
				'effect'                    => 'dark',
				'coverratio'                => '3:4',
				'magicbox_gap'              => 'sm',
				'count'                     => 4,
				'color_text'                => '#333333',
				'background_pack'           => 'gradient',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#c4c2d0',
				'background_gradient_from'  => '#bce2e6',
				'background_color'          => '#dcdbd9',
			]
		];
	}


	public static function p5($_title = null)
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'outside',
				'post_show_image'           => true,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'height'                    => 'fullscreen',
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 4,
				'color_text'                => '#333333',
				'background_pack'           => 'solid',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#1663a9',
				'background_gradient_from'  => '#0ff53b',
				'background_color'          => '#000000',
			]
		];
	}


	public static function p6($_title = null)
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'inside',
				'post_show_image'           => true,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'squircle',
				'height'                    => 'fullscreen',
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 8,
				'color_text'                => '#333333',
				'background_pack'           => 'solid',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#1663a9',
				'background_gradient_from'  => '#0ff53b',
				'background_color'          => '#f4c815',
			]
		];
	}


	public static function p7($_title = null)
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'hide',
				'post_show_image'           => true,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'heart',
				'height'                    => 'fullscreen',
				'effect'                    => 'light',
				'coverratio'                => '1:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 1,
				'color_text'                => '#333333',
				'background_pack'           => 'solid',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#1663a9',
				'background_gradient_from'  => '#0ff53b',
				'background_color'          => '#ffc0cb',
			]
		];
	}


	public static function p8($_title = null)
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'outside',
				'post_show_image'           => true,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'hexagon-2',
				'height'                    => 'fullscreen',
				'effect'                    => 'none',
				'coverratio'                => '1:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 3,
				'color_text'                => '#333333',
				'background_pack'           => 'solid',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#1663a9',
				'background_gradient_from'  => '#0ff53b',
				'background_color'          => '#8fa2a6',
			]
		];
	}


	public static function p9($_title = null)
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'hide',
				'post_show_image'           => true,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'parallelogram',
				'height'                    => 'fullscreen',
				'effect'                    => 'none',
				'coverratio'                => '1:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 3,
				'color_text'                => '#333333',
				'background_pack'           => 'gradient',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#e6a691',
				'background_gradient_from'  => '#915118',
				'background_color'          => '#8fa2a6',
			]
		];
	}


	public static function p10($_title = null)
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'outside',
				'post_show_image'           => true,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'parallelogram-4',
				'height'                    => 'fullscreen',
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 4,
				'color_text'                => '#333333',
				'background_pack'           => 'gradient',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#674c4b',
				'background_gradient_from'  => '#1f1004',
				'background_color'          => '#8fa2a6',
			]
		];
	}


	public static function p11($_title = null)
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'outside',
				'post_show_image'           => true,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'secondary',
				'image_mask'                => 'none',
				'height'                    => 'fullscreen',
				'effect'                    => 'dark',
				'coverratio'                => '16:9',
				'magicbox_gap'              => 'sm',
				'count'                     => 7,
				'color_text'                => '#333333',
				'background_pack'           => 'none',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#0db8d9',
				'background_gradient_from'  => '#0b2365',
				'background_color'          => '#8fa2a6',
			]
		];
	}


	public static function p12($_title = null)
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'inside',
				'post_show_image'           => true,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'height'                    => 'fullscreen',
				'effect'                    => 'dark',
				'coverratio'                => '16:9',
				'magicbox_gap'              => 'sm',
				'count'                     => 6,
				'color_text'                => '#333333',
				'background_pack'           => 'solid',
				'background_image'          => null,
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#0db8d9',
				'background_gradient_from'  => '#0b2365',
				'background_color'          => '#eeeeee',
			]
		];
	}

}
?>