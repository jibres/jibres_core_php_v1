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
			'options'      => option::master_option(),
			'preview_list' =>
			[
				'p1',
				'p2',
				'p3',
				'p4',
				'p5',
				'p6',
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
			'preview_title'  => T_("Preview :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[
				'type'                  => 'b1',
				'post_template'         => 'any',
				'post_tag'              => null,
				'post_show_readingtime' => '1',
				'post_show_image'       => '1',
				'post_show_excerpt'     => '1',
				'post_show_date'        => 'relative',
				'post_show_author'      => '1',
				'post_order'            => 'latest',
				'key'                   => 'blog',
				'height'                => 'm',
				'heading_position'      => 'center',
				'heading'               => $_title,
				'coverratio'            => '16:9',
				'count'                 => 3,
				'color_text'            => '#333333',
				'btn_viewall_check'     => '1',
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
			'preview_title'  => T_("Preview :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[
				'type'                  => 'b1',
				'post_template'         => 'any',
				'post_tag'              => null,
				'post_show_readingtime' => null,
				'post_show_image'       => '1',
				'post_show_excerpt'     => 1,
				'post_show_date'        => 'no',
				'post_show_author'      => null,
				'post_order'            => 'latest',
				'key'                   => 'blog',
				'height'                => 'm',
				'heading_position'      => 'center',
				'heading'               => $_title,
				'coverratio'            => '1:1',
				'count'                 => 4,
				'color_text'            => '#333333',
				'btn_viewall_check'     => '1',
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
			'preview_title'  => T_("Preview :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b1',
				'post_template'            => 'any',
				'post_tag'                 => null,
				'post_show_readingtime'    => null,
				'post_show_image'          => 1,
				'post_show_excerpt'        => 1,
				'post_show_date'           => 'date',
				'post_show_author'         => null,
				'post_order'               => 'latest',
				'key'                      => 'blog',
				'height'                   => 'l',
				'heading_position'         => 'center',
				'heading'                  => null,
				'coverratio'               => '16:9',
				'count'                    => 2,
				'color_text'               => '#333333',
				'btn_viewall_mode'         => null,
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
			'preview_title'  => T_("Preview :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b1',
				'post_template'            => 'any',
				'post_tag'                 => null,
				'post_show_readingtime'    => null,
				'post_show_image'          => null,
				'post_show_excerpt'        => 1,
				'post_show_date'           => 'full',
				'post_show_author'         => 1,
				'post_order'               => 'latest',
				'key'                      => 'blog',
				'height'                   => 'l',
				'heading_position'         => 'center',
				'heading'                  => null,
				'coverratio'               => '16:9',
				'count'                    => 6,
				'color_text'               => '#333333',
				'btn_viewall_mode'         => null,
				'btn_viewall_check'        => null,
				'background_pack'          => 'solid',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#1e19c5',
				'background_gradient_from' => '#f81b73',
				'background_color'         => '#90cdc3',
			],
		];
	}


	public static function p5($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Preview :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b1',
				'post_template'            => 'any',
				'post_tag'                 => null,
				'post_show_readingtime'    => null,
				'post_show_image'          => null,
				'post_show_excerpt'        => 1,
				'post_show_date'           => 'no',
				'post_show_author'         => null,
				'post_order'               => 'latest',
				'key'                      => 'blog',
				'height'                   => 'l',
				'heading_position'         => 'center',
				'heading'                  => null,
				'coverratio'               => '16:9',
				'count'                    => 1,
				'color_text'               => '#333333',
				'btn_viewall_mode'         => null,
				'btn_viewall_check'        => null,
				'btn_viewall'              => T_('View all'),
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#e378d1',
				'background_gradient_from' => '#9ef5e6',
				'background_color'         => '#90cdc3',
			],
		];
	}


	public static function p6($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Preview :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b1',
				'post_template'            => 'any',
				'post_tag'                 => null,
				'post_show_readingtime'    => null,
				'post_show_image'          => null,
				'post_show_excerpt'        => 1,
				'post_show_date'           => 'no',
				'post_show_author'         => null,
				'post_order'               => 'latest',
				'key'                      => 'blog',
				'height'                   => 'l',
				'heading_position'         => 'center',
				'heading'                  => null,
				'coverratio'               => '16:9',
				'count'                    => 1,
				'color_text'               => '#333333',
				'btn_viewall_mode'         => null,
				'btn_viewall_check'        => null,
				'btn_viewall'              => T_('View all'),
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#e378d1',
				'background_gradient_from' => '#9ef5e6',
				'background_color'         => '#90cdc3',
			],
		];
	}
}
?>