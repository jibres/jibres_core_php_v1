<?php
namespace content_site\body\blog;


class b3
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
			'title'        => T_("Classic"),
			'options'      =>
			[
				'heading',
				'description',
				'post_tag',
				'post_template',
				'post_order',
				'count_post_50',
				'post_show_date',
				'post_show_excerpt',
				'post_show_read_more',
				'btn_viewall',
				'style' => \content_site\utility::set_style_option(
				[
					'font',
					'background_pack',
					'heading_justify',
					'heading_size',
					'color_heading',
					'color_text',
					'link_color_post_read_more',
					'btn_viewall_mode',
				]),
				'spacing' =>
				[
					'height',
					'padding_top',
					'padding_bottom',
				],
				'responsive' => \content_site\utility::set_responsive_option(),

			],
			'default'      =>
			[
				'heading'           => T_("Latest Posts"),
				'post_template'     => 'any',
				'post_order'        => 'latest',
				'count'             => 3,
				'post_show_date'    => 'relative',
				'post_show_excerpt' => true,
				'btn_viewall_check' => true,
				'btn_viewall'       => T_("View all"),
				'background_pack'   => 'none',
				'height'            => 'md',
				'color_text'        => '#333333',
				'heading_position'  => 'center',
				'btn_viewall_mode'  => 'dark',
			],

			'preview_list' =>
			[
				'p1',
				'p2',
				'p3',
				'p4',
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
				'post_show_read_more' => true,
				'post_show_excerpt'   => true,
				'post_show_date'      => 'relative',
				'link_color'          => 'primary',
				'height'              => 'fullscreen',
				'heading_position'    => 'left',
				'heading'             => $_title,
				'description'         => 'All the latest news, straight from the team.',
				'count'               => 5,
				'color_text'          => '#444444',
				'color_heading'       => '#000000',
				'btn_viewall_mode'    => 'dark',
				'btn_viewall_check'   => '1',
				'btn_viewall'         => T_("View all"),
				'background_pack'     => 'none',
			],
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
				'post_show_read_more' => null,
				'post_show_excerpt'   => true,
				'post_show_date'      => 'no',
				'link_color'          => 'primary',
				'height'              => 'fullscreen',
				'heading_position'    => 'left',
				'heading'             => $_title,
				'description'         => 'All the latest news, straight from the team.',
				'count'               => 2,
				'color_text'          => '#444444',
				'color_heading'       => '#000000',
				'btn_viewall_mode'    => 'secondary',
				'btn_viewall_check'   => '1',
				'btn_viewall'         => T_("View all"),
				'background_pack'     => 'solid',
				'background_color'    => '#eeeeee',
			],
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
				'post_show_read_more' => null,
				'post_show_excerpt'   => true,
				'post_show_date'      => 'date',
				'link_color'          => 'primary',
				'height'              => 'fullscreen',
				'heading_position'    => 'left',
				'heading'             => $_title,
				'description'         => 'All the latest news, straight from the team.',
				'count'               => 2,
				'color_text'          => '#ffffff',
				'color_heading'       => '#c2b500',
				'btn_viewall_mode'    => 'light',
				'btn_viewall_check'   => '1',
				'btn_viewall'         => T_("View all"),
				'background_pack'     => 'solid',
				'background_color'    => '#000000',
			],
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
				'post_show_read_more'      => null,
				'post_show_excerpt'        => null,
				'post_show_date'           => 'full',
				'link_color'               => 'primary',
				'key'                      => 'blog',
				'height'                   => 'fullscreen',
				'heading_position'         => 'left',
				'heading'                  => $_title,
				'description'              => 'All the latest news, straight from the team.',
				'count'                    => 2,
				'color_text'               => '#ffffff',
				'color_heading'            => '#ffffff',
				'btn_viewall_mode'         => 'light',
				'btn_viewall_check'        => '1',
				'btn_viewall'              => T_("View all"),
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom left',
				'background_gradient_to'   => '#bac8e0',
				'background_gradient_from' => '#6a85b6',
				'background_color'         => '#000000',
			],
		];
	}

}
?>