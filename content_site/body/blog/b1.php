<?php
namespace content_site\body\blog;


class b1
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
			'title'        => T_("Card Design"),
			'default'      => option::master_default(['type' => 'b1']),
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

				'post_show_image',
				'post_show_readingtime',
				'post_show_excerpt',
				'post_show_author',

				'btn_viewall',
				'post_show_date',

				// sub page
				'style' => \content_site\options\style::option_list(
				[
					'height',
					'coverratio',
					'background_pack',
					'color_text',
					'font',
					'btn_viewall_mode',
					'type',
				]),

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
				'p8',
				'p9',
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
				'key'                   => 'blog',
				'type'                  => 'b1',
				'post_show_readingtime' => 1,
				'post_show_image'       => 1,
				'post_show_excerpt'     => 1,
				'post_show_date'        => 'relative',
				'post_show_author'      => 1,
				'height'                => 'm',
				'heading_position'      => 'center',
				'heading'               => $_title,
				'coverratio'            => '16:9',
				'count'                 => 3,
				'color_text'            => '#333333',
				'btn_viewall_check'     => 1,
				'btn_viewall'           => T_('View all'),
				'background_pack'       => 'none',
			],
		];
	}


	public static function p2($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Sample :val", ['val' => \dash\fit::number(2)]),
			'version'        => 1,
			'options' =>
			[
				'type'                  => 'b1',
				'post_show_readingtime' => null,
				'post_show_image'       => 1,
				'post_show_excerpt'     => 1,
				'post_show_date'        => 'no',
				'post_show_author'      => null,
				'key'                   => 'blog',
				'height'                => 'm',
				'heading_position'      => 'center',
				'heading'               => $_title,
				'coverratio'            => '1:1',
				'count'                 => 4,
				'color_text'            => '#333333',
				'btn_viewall_check'     => 1,
				'btn_viewall'           => T_('View all'),
				'background_pack'       => 'solid',
				'background_color'      => '#dec4d6',
			],
		];
	}


	public static function p3($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Sample :val", ['val' => \dash\fit::number(3)]),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b1',
				'post_show_readingtime'    => null,
				'post_show_image'          => 1,
				'post_show_excerpt'        => 1,
				'post_show_date'           => 'date',
				'post_show_author'         => null,
				'key'                      => 'blog',
				'height'                   => 'l',
				'heading_position'         => 'center',
				'heading'                  => null,
				'coverratio'               => '16:9',
				'count'                    => 2,
				'color_text'               => '#333333',
				'btn_viewall_check'        => null,
				'btn_viewall'              => T_('View all'),
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#1e19c5',
				'background_gradient_from' => '#f81b73',
			],
		];
	}


	public static function p4($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Sample :val", ['val' => \dash\fit::number(4)]),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b1',
				'post_show_readingtime'    => null,
				'post_show_image'          => null,
				'post_show_excerpt'        => 1,
				'post_show_date'           => 'full',
				'post_show_author'         => 1,
				'key'                      => 'blog',
				'height'                   => 'l',
				'heading_position'         => 'center',
				'heading'                  => null,
				'coverratio'               => '16:9',
				'count'                    => 6,
				'color_text'               => '#333333',
				'btn_viewall_check'        => null,
				'background_pack'          => 'solid',
				'background_color'         => '#90cdc3',
			],
		];
	}


	public static function p5($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Sample :val", ['val' => \dash\fit::number(5)]),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b1',
				'post_show_readingtime'    => null,
				'post_show_image'          => null,
				'post_show_excerpt'        => 1,
				'post_show_date'           => 'no',
				'post_show_author'         => null,
				'key'                      => 'blog',
				'height'                   => 'l',
				'heading_position'         => 'center',
				'heading'                  => null,
				'coverratio'               => '16:9',
				'count'                    => 1,
				'color_text'               => '#333333',
				'btn_viewall_check'        => null,
				'btn_viewall'              => T_('View all'),
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#e378d1',
				'background_gradient_from' => '#9ef5e6',
			],
		];
	}


	public static function p6($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Sample :val", ['val' => \dash\fit::number(6)]),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b1',
				'post_show_readingtime'    => null,
				'post_show_image'          => 1,
				'post_show_excerpt'        => 1,
				'post_show_date'           => 'relative',
				'post_show_author'         => 1,
				'key'                      => 'blog',
				'height'                   => 'm',
				'heading_position'         => 'center',
				'heading'                  => null,
				'coverratio'               => '3:4',
				'count'                    => 4,
				'color_text'               => '#333333',
				'btn_viewall_check'        => null,
				'btn_viewall'              => T_("View all"),
				'background_pack'          => 'solid',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#e378d1',
				'background_gradient_from' => '#9ef5e6',
				'background_color'         => '#e7cba9',
			],
		];
	}


	public static function p7($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Sample :val", ['val' => \dash\fit::number(7)]),
			'version'        => 1,
			'options' =>
			[
				'type'                    => 'b1',
				'post_show_readingtime'   => null,
				'post_show_image'         => 1,
				'post_show_excerpt'       => 1,
				'post_show_date'          => 'no',
				'post_show_author'        => null,
				'key'                     => 'blog',
				'height'                  => 's',
				'heading_position'        => 'center',
				'heading'                 => null,
				'coverratio'              => '3:1',
				'count'                   => 9,
				'color_text'              => '#022b79',
				'btn_viewall_check'       => null,
				'btn_viewall'             => T_('View all'),
				'background_size'         => 'auto',
				'background_pack'         => 'gradient',
				'background_gradient_type'=> 'to bottom',
				'background_gradient_to'  => '#ffffff',
				'background_gradient_from'=> '#c1e3ec',
			],
		];
	}


	public static function p8($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Sample :val", ['val' => \dash\fit::number(8)]),
			'version'        => 1,
			'options' =>
			[
				'type'                  => 'b1',
				'post_show_readingtime' => null,
				'post_show_image'       => 1,
				'post_show_excerpt'     => null,
				'post_show_date'        => 'no',
				'post_show_author'      => null,
				'key'                   => 'blog',
				'height'                => 'm',
				'heading_position'      => 'left',
				'heading'               => $_title,
				'coverratio'            => '16:9',
				'count'                 => 7,
				'color_text'            => '#333333',
				'btn_viewall_check'     => null,
				'btn_viewall'           => T_("View all"),
				'background_pack'       => 'solid',
				'background_color'      => '#eeeeee',
			],
		];
	}


	public static function p9($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Sample :val", ['val' => \dash\fit::number(9)]),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b1',
				'post_show_readingtime'    => null,
				'post_show_image'          => null,
				'post_show_excerpt'        => 1,
				'post_show_date'           => 'no',
				'post_show_author'         => null,
				'key'                      => 'blog',
				'height'                   => 'm',
				'heading_position'         => 'left',
				'heading'                  => $_title,
				'coverratio'               => '16:9',
				'count'                    => 9,
				'color_text'               => '#333333',
				'btn_viewall_check'        => 1,
				'btn_viewall'              => T_("View all"),
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom left',
				'background_gradient_to'   => '#b3c6db',
				'background_gradient_from' => '#e4f2f7',
				'background_color'         => '#eeeeee',
			],
		];
	}
}
?>