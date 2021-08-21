<?php
namespace content_site\body\blog;


class b2
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
			'title'        => T_("Magic box"),
			'default'      => option::master_default(['type' => 'b2', 'post_title_position' => 'inside', 'effect' => 'zoom', 'link_color_post_title' => 'light']),
			'options'      =>
			[
				// 'group_setting',
				// text
				'heading_full',
				// select
				'post_tag',
				'post_template',

				'post_order',
				// range
				'count_post',

				'post_title_position',
				'btn_viewall',

				// sub page
				'style' => \content_site\options\style::option_list(
				[

					'font',
					'height',
					'background_pack',
					'color_heading',
					'radius_full',
					'coverratio',
					'effect',
					'image_mask',
					'link_color_post_title',
					'btn_viewall_mode',
					'type',
				]),
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
			'preview_title'  => T_("Card"),
			'version'        => 1,
			'options' =>
			[
				'type'                  => 'b2',
				'radius_normal'         => 'none',
				'radius'                => 'lg',
				'post_title_position'   => 'inside',
				'post_show_readingtime' => '1',
				'post_show_image'       => '1',
				'post_show_excerpt'     => '1',
				'post_show_date'        => 'relative',
				'post_show_author'      => '1',
				'link_color_post_title' => 'light',
				'link_color'            => 'light',
				'key'                   => 'blog',
				'height'                => 'fullscreen',
				'heading_position'      => 'center',
				'heading'               => $_title,
				'effect'                => 'dark',
				'coverratio'            => '16:9',
				'count'                 => 12,
				'color_text'            => '#333333',
				'btn_viewall_check'     => '1',
				'btn_viewall'           => T_("View all"),
				'background_pack'       => 'none',
			]
		];
	}


	public static function p2($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Card"),
			'version'        => 1,
			'options' =>
			[
				'type'                  => 'b2',
				'radius_normal'         => 'none',
				'radius'                => 'none',
				'post_title_position'   => 'inside',
				'post_show_readingtime' => '1',
				'post_show_image'       => '1',
				'post_show_excerpt'     => '1',
				'post_show_date'        => 'relative',
				'post_show_author'      => '1',
				'link_color_post_title' => 'light',
				'link_color'            => 'light',
				'key'                   => 'blog',
				'image_mask'            => 'none',
				'height'                => 'fullscreen',
				'heading_position'      => 'center',
				'heading'               => $_title,
				'effect'                => 'dark',
				'coverratio'            => '3:1',
				'count'                 => 10,
				'color_text'            => '#333333',
				'color_heading'         => '#0173cb',
				'btn_viewall_check'     => '1',
				'btn_viewall'           => T_("View all"),
				'background_pack'       => 'solid',
				'background_color'      => '#e5faff',
			]
		];
	}


	public static function p3($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Card"),
			'version'        => 1,
			'options' =>
			[
				'type'                  => 'b2',
				'radius_normal'         => 'none',
				'radius'                => 'normal',
				'post_title_position'   => 'inside',
				'post_show_readingtime' => '1',
				'post_show_image'       => '1',
				'post_show_excerpt'     => '1',
				'post_show_date'        => 'relative',
				'post_show_author'      => '1',
				'link_color_post_title' => 'light',
				'link_color'            => 'light',
				'key'                   => 'blog',
				'image_mask'            => 'squircle',
				'height'                => 'fullscreen',
				'heading_position'      => 'center',
				'heading'               => $_title,
				'effect'                => 'dark',
				'coverratio'            => '1:1',
				'count'                 => 8,
				'color_text'            => '#333333',
				'color_heading'         => '#000000',
				'btn_viewall_check'     => '1',
				'btn_viewall'           => T_("View all"),
				'background_pack'       => 'solid',
				'background_color'      => '#dcdbd9',
			]
		];
	}
}
?>