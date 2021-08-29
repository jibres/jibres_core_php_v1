<?php
namespace content_site\body\product;


class p4
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
			'title'        => T_("Magic Slider"),
			'options'      =>
			[
				'heading_full',

				'product_tag',
				'product_order',
				'count_product_p4',
				// 'magicbox_title_position',
				'product_show_title_price_magicbox',
				// 'product_show_price',

				'btn_viewall',
				'slider_setting' =>
				[
					'slider_effect',
					'slider_autoplay',
					'slider_next_prev',
					'slider_size',
				],
				'style' => \content_site\utility::set_style_option(
				[
					'font',
					'height',
					'container_product_p4',
					'background_pack',
					'color_heading',
					'radius_full',
					'coverratio',
					'effect',
					'image_mask',
					'link_color_magicbox_title',
					'btn_viewall_mode',
				]),
			],
			'default'      =>
			[
				'heading'                   => T_("Latest Posts"),
				'post_template'             => 'any',
				'post_order'                => 'latest',
				'count'                     => 3,
				'btn_viewall_check'         => true,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'none',
				'height'                    => 'md',
				'coverratio'                => '16:9',
				'magicbox_gap'              => 'sm',
				'color_text'                => '#333333',
				'heading_position'          => 'center',
				'btn_viewall_mode'          => 'dark',
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'inside',
				'effect'                    => 'zoom',
				'link_color_magicbox_title' => 'light'
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
				// 'p12',
			],
		];
	}


	/**
	 * Preview 1
	 */
	public static function p1($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'inside',
				'post_show_image'           => 1,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'height'                    => 'fullscreen',
				'heading_position'          => 'center',
				'heading'                   => $_title,
				'effect'                    => 'dark',
				'coverratio'                => '16:9',
				'magicbox_gap'              => 'sm',
				'count'                     => 12,
				'color_text'                => '#333333',
				'btn_viewall_check'         => 1,
				'btn_viewall_mode'          => 'dark',
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'none',
			]
		];
	}


	public static function p2($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'inside',
				'post_show_image'           => 1,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'height'                    => 'fullscreen',
				'heading_position'          => 'center',
				'heading'                   => $_title,
				'effect'                    => 'dark',
				'coverratio'                => '3:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 10,
				'color_text'                => '#333333',
				'color_heading'             => '#0173cb',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'btn_viewall_mode'          => 'primary',
				'background_pack'           => 'solid',
				'background_color'          => '#e5faff',
			]
		];
	}


	public static function p3($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'inside',
				'post_show_image'           => 1,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'height'                    => 'fullscreen',
				'heading_position'          => 'center',
				'heading'                   => $_title,
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 8,
				'color_text'                => '#333333',
				'color_heading'             => '#000000',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'btn_viewall_mode'          => 'dark',
				'background_pack'           => 'solid',
				'background_color'          => '#dcdbd9',
			]
		];
	}


	public static function p4($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'inside',
				'post_show_image'           => 1,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'height'                    => 'fullscreen',
				'heading_position'          => 'center',
				'heading'                   => $_title,
				'effect'                    => 'dark',
				'coverratio'                => '3:4',
				'magicbox_gap'              => 'sm',
				'count'                     => 4,
				'color_text'                => '#333333',
				'color_heading'             => '#000000',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'btn_viewall_mode'          => 'dark',
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
		$_title = T_("Latest Posts");
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'outside',
				'post_show_image'           => 1,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'height'                    => 'fullscreen',
				'heading_position'          => 'center',
				'heading'                   => $_title,
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 4,
				'color_text'                => '#333333',
				'color_heading'             => '#d7bf1d',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'btn_viewall_mode'          => 'light',
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
		$_title = T_("Latest Posts");
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'inside',
				'post_show_image'           => 1,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'squircle',
				'height'                    => 'fullscreen',
				'heading_position'          => 'left',
				'heading'                   => $_title,
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 8,
				'color_text'                => '#333333',
				'color_heading'             => '#000000',
				'btn_viewall_check'         => null,
				'btn_viewall'               => T_("View all"),
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
		$_title = T_("Latest Posts");
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'hide',
				'post_show_image'           => 1,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'heart',
				'height'                    => 'fullscreen',
				'heading_position'          => 'center',
				'heading'                   => $_title,
				'effect'                    => 'light',
				'coverratio'                => '1:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 1,
				'color_text'                => '#333333',
				'color_heading'             => '#ff1493',
				'btn_viewall_check'         => null,
				'btn_viewall'               => T_("View all"),
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
		$_title = T_("Latest Posts");
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'outside',
				'post_show_image'           => 1,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'hexagon-2',
				'height'                    => 'fullscreen',
				'heading_position'          => 'center',
				'heading'                   => $_title,
				'effect'                    => 'none',
				'coverratio'                => '1:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 3,
				'color_text'                => '#333333',
				'color_heading'             => '#ffffff',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'btn_viewall_mode'          => 'light',
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
		$_title = T_("Latest Posts");
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'hide',
				'post_show_image'           => 1,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'parallelogram',
				'height'                    => 'fullscreen',
				'heading_position'          => 'center',
				'heading'                   => null,
				'effect'                    => 'none',
				'coverratio'                => '1:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 3,
				'color_text'                => '#333333',
				'color_heading'             => '#ffffff',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'btn_viewall_mode'          => 'light',
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
		$_title = T_("Latest Posts");
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'outside',
				'post_show_image'           => 1,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'parallelogram-4',
				'height'                    => 'fullscreen',
				'heading_position'          => 'center',
				'heading'                   => $_title,
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'magicbox_gap'              => 'sm',
				'count'                     => 4,
				'color_text'                => '#333333',
				'color_heading'             => '#ffffff',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'btn_viewall_mode'          => 'light',
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
		$_title = T_("Latest Posts");
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'outside',
				'post_show_image'           => 1,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'secondary',
				'image_mask'                => 'none',
				'height'                    => 'fullscreen',
				'heading_position'          => 'center',
				'heading'                   => $_title,
				'effect'                    => 'dark',
				'coverratio'                => '16:9',
				'magicbox_gap'              => 'sm',
				'count'                     => 7,
				'color_text'                => '#333333',
				'color_heading'             => '#333333',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'btn_viewall_mode'          => 'dark',
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
		$_title = T_("Latest Posts");
		return
		[
			'version'        => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'inside',
				'post_show_image'           => 1,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'height'                    => 'fullscreen',
				'heading_position'          => 'center',
				'heading'                   => $_title,
				'effect'                    => 'dark',
				'coverratio'                => '16:9',
				'magicbox_gap'              => 'sm',
				'count'                     => 6,
				'color_text'                => '#333333',
				'color_heading'             => '#333333',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'btn_viewall_mode'          => 'dark',
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