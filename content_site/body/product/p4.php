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
				'heading',

				'product_tag',
				'product_filter_image',
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
					'background_pack',
					'justify_heading',
					'heading_size',
					'color_heading',
					'radius_full',
					'coverratio',
					'effect',
					'image_mask',
					'link_color_magicbox_title',
					'btn_viewall_mode',
				]),
				'spacing' =>
				[
					'height',
					'padding_top',
					'padding_bottom',
					'container_product_p4',
				],
				'responsive' => ['responsive_device',],
			],
			'default'      =>
			[
				'heading'                   => T_("Latest Posts"),
				'post_order'                => 'newest',
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
				'p2',
				'p3',
				'p4',
				'p5',
				'p6',
				'p7',
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
				'slider_size'               => 'sm',
				'slider_next_prev'          => true,
				'slider_effect'             => 'slide',
				'slider_autoplay'           => 5,
				'radius'                    => 'lg',
				'product_show_title'        => true,
				'product_show_price'        => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'height'                    => 'sm',
				'heading_position'          => 'center',
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'count'                     => 15,
				'container'                 => 'xl',
				'color_text'                => '#333333',
				'btn_viewall_mode'          => 'dark',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'none',
				'background_color'          => '#37667e',
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
				'slider_size'               => 'md',
				'slider_next_prev'          => true,
				'slider_effect'             => 'slide',
				'slider_autoplay'           => 5,
				'radius'                    => 'lg',
				'product_show_title'        => true,
				'product_show_price'        => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'height'                    => 'sm',
				'heading_position'          => 'center',
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'count'                     => 15,
				'container'                 => 'xl',
				'color_text'                => '#333333',
				'btn_viewall_mode'          => 'dark',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'none',
				'background_color'          => '#37667e',
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
				'slider_size'               => 'lg',
				'slider_next_prev'          => true,
				'slider_effect'             => 'slide',
				'slider_autoplay'           => 5,
				'radius'                    => 'lg',
				'product_show_title'        => true,
				'product_show_price'        => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'height'                    => 'sm',
				'heading_position'          => 'center',
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'count'                     => 15,
				'container'                 => 'xl',
				'color_text'                => '#333333',
				'btn_viewall_mode'          => 'dark',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'none',
				'background_color'          => '#37667e',
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
				'slider_size'               => 'xl',
				'slider_next_prev'          => true,
				'slider_effect'             => 'slide',
				'slider_autoplay'           => 5,
				'radius'                    => 'lg',
				'product_show_title'        => true,
				'product_show_price'        => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'height'                    => 'sm',
				'heading_position'          => 'center',
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'count'                     => 15,
				'container'                 => 'xl',
				'color_text'                => '#333333',
				'btn_viewall_mode'          => 'dark',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'none',
				'background_color'          => '#37667e',
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
				'slider_size'               => 'md',
				'slider_next_prev'          => true,
				'slider_effect'             => 'coverflow',
				'slider_autoplay'           => 5,
				'radius'                    => 'lg',
				'product_show_title'        => true,
				'product_show_price'        => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'height'                    => 'md',
				'heading_position'          => 'center',
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'count'                     => 15,
				'container'                 => 'xl',
				'color_text'                => '#333333',
				'btn_viewall_mode'          => 'dark',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'gradient',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#e2d1c3',
				'background_gradient_from'  => '#fdfcfb',
				'background_color'          => '#37667e',
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
				'slider_size'               => 'md',
				'slider_next_prev'          => true,
				'slider_effect'             => 'slide',
				'slider_autoplay'           => 5,
				'radius'                    => '3xl',
				'product_show_title'        => true,
				'product_show_price'        => true,
				'magicbox_title_position'   => 'outside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'dark',
				'height'                    => 'md',
				'heading_position'          => 'center',
				'effect'                    => 'zoom',
				'coverratio'                => '1:1',
				'count'                     => 15,
				'container'                 => 'xl',
				'color_text'                => '#333333',
				'btn_viewall_mode'          => 'dark',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'gradient',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#e6dee9',
				'background_gradient_from'  => '#fdcbf1',
				'background_color'          => '#37667e',
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
				'slider_size'               => 'lg',
				'slider_next_prev'          => true,
				'slider_effect'             => 'coverflow',
				'slider_autoplay'           => 5,
				'radius'                    => '3xl',
				'product_show_title'        => true,
				'product_show_price'        => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'height'                    => 'md',
				'heading_position'          => 'center',
				'heading'                   => $_title,
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'count'                     => 15,
				'container'                 => 'xl',
				'color_text'                => '#333333',
				'color_heading'             => '#ffffff',
				'btn_viewall_mode'          => 'light',
				'btn_viewall_check'         => 1,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'solid',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#757089',
				'background_gradient_from'  => '#09b5c7',
				'background_color'          => '#0e4662',
			]
		];
	}

}
?>