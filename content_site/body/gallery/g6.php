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
					'background_pack',
					'radius_full',
					'coverratio_no_free',
					'effect',
					'image_mask',
					// 'link_color_magicbox_title',
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
			// 'break_image_list' => 4,
			'maximum_capacity' => 14,
			'minimum_item'     => 1,
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
			],
		];


	}


	/**
	 * Preview 1
	 */



	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:48:03
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/gallery/g6.php
	 * body / gallery / g6 / p1
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
	// path content_site/body/gallery/g6.php
	// body / gallery / g6 / p1

}
?>