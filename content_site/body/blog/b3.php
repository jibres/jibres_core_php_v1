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
			'title'        => T_("Classic View"),
			'options'      =>
			[
				'heading_full',
				'description',
				'post_tag',
				'post_template',
				'post_order',
				'count_post_50',
				'post_show_date',
				'post_show_excerpt',
				'post_show_read_more',
				'btn_viewall',
				'style' => \content_site\options\style::option_list(
				[
					'font',
					'height',
					'background_pack',
					'color_heading',
					'color_text',
					'link_color_post_read_more',
					'btn_viewall_mode',
					'type',
				]),

			],
			'default'      =>
			[
				'type'              => 'b3',
				'heading'           => T_("Latest Posts"),
				'post_template'     => 'any',
				'post_order'        => 'latest',
				'count'             => 3,
				'post_show_date'    => 'relative',
				'post_show_excerpt' => 1,
				'btn_viewall_check' => true,
				'btn_viewall'       => T_("View all"),
				'background_pack'   => 'none',
				'height'            => 'm',
				'color_text'        => '#333333',
				'heading_position'  => 'center',
				'btn_viewall_mode'  => 'dark',
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
			'preview_title'  => T_("Sample :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[
				'type'                => 'b3',
				'post_show_read_more' => 1,
				'post_show_excerpt'   => 1,
				'post_show_date'      => 'relative',
				'link_color'          => 'primary',
				'key'                 => 'blog',
				'height'              => 'fullscreen',
				'heading_position'    => 'left',
				'heading'             => $_title,
				'description'         => 'All the latest news, straight from the team.',
				'count'               => 2,
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
			'preview_title'  => T_("Sample :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[

			],
		];
	}


	public static function p3($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Sample :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[

			],
		];
	}


	public static function p4($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Sample :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[

			],
		];
	}


	public static function p5($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Sample :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[

			],
		];
	}
}
?>