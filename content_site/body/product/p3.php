<?php
namespace content_site\body\product;


class p3
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
					'radius_normal',
					'coverratio',
					'btn_viewall_mode',
				]),
			],
			'default'      =>
			[
				'heading'               => T_("Products"),
				'product_order'            => 'latest',
				'count'                 => 3,
				'product_show_image'       => true,
				'btn_viewall_check'     => true,
				'btn_viewall'           => T_("View all"),
				'background_pack'       => 'none',
				'height'                => 'md',
				'coverratio'            => '16:9',
				'color_text'            => '#333333',
				'heading_position'      => 'center',
				'btn_viewall_mode'      => 'dark',
				'radius_normal'         => 'none',
			],
			'preview_list' =>
			[
				'p1',
			],
		];
	}


	/**
	 * Preview 1
	 */
	public static function p1($_title = null)
	{
		$_title = T_("Products");
		return
		[
			'version'        => 1,
			'options' =>
			[
				'slider_size'             => 'sm',
				'slider_next_prev'        => true,
				'slider_effect'           => 'slide',
				'slider_autoplay'         => 5,
				'radius_normal'           => 'none',
				'radius'                  => 'lg',
				'product_tag'             => 3,
				'product_show_title'      => true,
				'product_show_price'      => true,
				'product_show_image'      => 1,
				'product_order'           => 'latest',
				'magicbox_title_position' => 'inside',
				'link_color'              => 'dark',
				'height'                  => 'sm',
				'heading_position'        => 'center',
				'coverratio'              => '1:1',
				'count'                   => 15,
				'container'               => 'xl',
				'color_text'              => '#333333',
				'btn_viewall_mode'        => 'dark',
				'btn_viewall_check'       => 1,
				'btn_viewall'             => T_("View all"),
				'background_pack'         => 'none',
				'background_color'        => '#218b82',
			],
		];
	}


	public static function p2($_title = null)
	{
		$_title = T_("Products");
		return
		[
			'version'        => 1,
			'options' =>
			[

			],
		];
	}


	public static function p3($_title = null)
	{
		$_title = T_("Products");
		return
		[
			'version'        => 1,
			'options' =>
			[

			],
		];
	}


	public static function p4($_title = null)
	{
		$_title = T_("Products");
		return
		[
			'version'        => 1,
			'options' =>
			[

			],
		];
	}


	public static function p5($_title = null)
	{
		$_title = T_("Products");
		return
		[
			'version'        => 1,
			'options' =>
			[

			],
		];
	}


	public static function p6($_title = null)
	{
		$_title = T_("Products");
		return
		[
			'version'        => 1,
			'options' =>
			[

			],
		];
	}


	public static function p7($_title = null)
	{
		$_title = T_("Products");
		return
		[
			'version'        => 1,
			'options' =>
			[

			],
		];
	}


	public static function p8($_title = null)
	{
		$_title = T_("Products");
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