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
				'heading_full',
				'post_tag',
				'post_template',
				'post_order',
				'count_post',
				'magicbox_title_position',
				'btn_viewall',
				'style' => \content_site\options\style::option_list(
				[
					'font',
					'height',
					'magicbox_gap',
					'background_pack',
					'color_heading',
					'radius_full',
					'coverratio',
					'effect',
					'image_mask',
					'link_color_magicbox_title',
					'btn_viewall_mode',
					'type',
				]),
			],
			'default'      =>
			[
				'type'                      => 'p2',
				'heading'                   => T_("Latest Posts"),
				'post_template'             => 'any',
				'post_order'                => 'latest',
				'count'                     => 3,
				'btn_viewall_check'         => true,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'none',
				'height'                    => 'm',
				'coverratio'                => '16:9',
				'magicbox_gap'              => 'sm',
				'color_text'                => '#333333',
				'heading_position'          => 'center',
				'btn_viewall_mode'          => 'dark',
				'radius_normal'             => 'none',
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
	public static function p1($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Magic Box"). ' - '. T_("Sample :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[
				'type'                      => 'p2',
				'radius_normal'             => 'none',
				'magicbox_title_position'   => 'inside',
				'post_show_image'           => 1,
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'key'                       => 'blog',
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

}
?>