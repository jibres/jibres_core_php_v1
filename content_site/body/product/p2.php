<?php
namespace content_site\body\product;


class p2
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
			'title'        => T_("Magic Box"),
			'options'      =>
			[
				'heading',

				'product_tag',
				'product_filter_image',
				'product_order',
				'count_product',
				'magicbox_title_position',
				'product_show_title',
				'product_show_price',
				'btn_viewall',
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
					'container',
					'magicbox_gap',
				],
				'responsive' =>
				[
					'responsive_device',
					'responsive_layout',
				],
			],
			'default'      =>
			[
				'heading'                   => T_("Latest Posts"),
				'product_order'                => 'newest',
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
			],
		];
	}


	/**
	 * Preview 1
	 */



	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:54:09
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/product/p2.php
	 * body / product / p2 / p1
	 *
	*/
	public static function p1()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'product_show_title'        => true,
				'product_show_price'        => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'height'                    => 'sm',
				'heading_position'          => 'center',
				'heading'                   => T_("Products"),
				'effect'                    => 'dark',
				'coverratio'                => '16:9',
				'count'                     => 12,
				'color_text'                => '#333333',
				'btn_viewall_mode'          => 'dark',
				'btn_viewall_check'         => true,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'none',
			],
		];
	}
	// path content_site/body/product/p2.php
	// body / product / p2 / p1
}
?>