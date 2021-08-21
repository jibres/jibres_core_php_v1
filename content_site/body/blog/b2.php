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
			'options'      =>
			[
				'heading_full',
				'post_tag',
				'post_template',
				'post_order',
				'count_post',
				'post_title_position',
				'btn_viewall',
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
			'default'      =>
			[
				'type'                  => 'b2',
				'heading'               => T_("Latest Posts"),
				'post_template'         => 'any',
				'post_order'            => 'latest',
				'count'                 => 3,
				'btn_viewall_check'     => true,
				'btn_viewall'           => T_("View all"),
				'background_pack'       => 'none',
				'height'                => 'm',
				'coverratio'            => '16:9',
				'color_text'            => '#333333',
				'heading_position'      => 'center',
				'btn_viewall_mode'      => 'dark',
				'radius_normal'         => 'none',
				'post_title_position'   => 'inside',
				'effect'                => 'zoom',
				'link_color_post_title' => 'light'
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
				'radius'                => '3xl',
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


	public static function p4($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Card"),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b2',
				'radius_normal'            => 'none',
				'radius'                   => '3xl',
				'post_title_position'      => 'inside',
				'post_show_readingtime'    => '1',
				'post_show_image'          => '1',
				'post_show_excerpt'        => '1',
				'post_show_date'           => 'relative',
				'post_show_author'         => '1',
				'link_color_post_title'    => 'light',
				'link_color'               => 'light',
				'key'                      => 'blog',
				'image_mask'               => 'none',
				'height'                   => 'fullscreen',
				'heading_position'         => 'center',
				'heading'                  => $_title,
				'effect'                   => 'dark',
				'coverratio'               => '3:4',
				'count'                    => 4,
				'color_text'               => '#333333',
				'color_heading'            => '#000000',
				'btn_viewall_check'        => '1',
				'btn_viewall'              => T_("View all"),
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#c4c2d0',
				'background_gradient_from' => '#bce2e6',
				'background_color'         => '#dcdbd9',
			]
		];
	}


	public static function p5($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Card"),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b2',
				'radius_normal'            => 'none',
				'radius'                   => 'full',
				'post_title_position'      => 'outside',
				'post_show_readingtime'    => '1',
				'post_show_image'          => '1',
				'post_show_excerpt'        => '1',
				'post_show_date'           => 'relative',
				'post_show_author'         => '1',
				'link_color_post_title'    => 'light',
				'link_color'               => 'light',
				'key'                      => 'blog',
				'image_mask'               => 'none',
				'height'                   => 'fullscreen',
				'heading_position'         => 'center',
				'heading'                  => $_title,
				'effect'                   => 'dark',
				'coverratio'               => '1:1',
				'count'                    => 4,
				'color_text'               => '#333333',
				'color_heading'            => '#d7bf1d',
				'btn_viewall_check'        => 1,
				'btn_viewall'              => T_("View all"),
				'background_pack'          => 'solid',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#1663a9',
				'background_gradient_from' => '#0ff53b',
				'background_color'         => '#000000',
			]
		];
	}


	public static function p6($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Card"),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b2',
				'radius_normal'            => 'none',
				'radius'                   => '3xl',
				'post_title_position'      => 'inside',
				'post_show_readingtime'    => '1',
				'post_show_image'          => '1',
				'post_show_excerpt'        => '1',
				'post_show_date'           => 'relative',
				'post_show_author'         => '1',
				'link_color_post_title'    => 'light',
				'link_color'               => 'light',
				'key'                      => 'blog',
				'image_mask'               => 'squircle',
				'height'                   => 'fullscreen',
				'heading_position'         => 'left',
				'heading'                  => $_title,
				'effect'                   => 'dark',
				'coverratio'               => '1:1',
				'count'                    => 8,
				'color_text'               => '#333333',
				'color_heading'            => '#000000',
				'btn_viewall_check'        => null,
				'btn_viewall'              => T_("View all"),
				'background_pack'          => 'solid',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#1663a9',
				'background_gradient_from' => '#0ff53b',
				'background_color'         => '#f4c815',
			]
		];
	}


	public static function p7($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Card"),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b2',
				'radius_normal'            => 'none',
				'radius'                   => 'normal',
				'post_title_position'      => 'hide',
				'post_show_readingtime'    => '1',
				'post_show_image'          => '1',
				'post_show_excerpt'        => '1',
				'post_show_date'           => 'relative',
				'post_show_author'         => '1',
				'link_color_post_title'    => 'light',
				'link_color'               => 'light',
				'key'                      => 'blog',
				'image_mask'               => 'heart',
				'height'                   => 'fullscreen',
				'heading_position'         => 'center',
				'heading'                  => $_title,
				'effect'                   => 'light',
				'coverratio'               => '1:1',
				'count'                    => 1,
				'color_text'               => '#333333',
				'color_heading'            => '#ff1493',
				'btn_viewall_check'        => null,
				'btn_viewall'              => T_("View all"),
				'background_pack'          => 'solid',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#1663a9',
				'background_gradient_from' => '#0ff53b',
				'background_color'         => '#ffc0cb',
			]
		];
	}


	public static function p8($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Card"),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b2',
				'radius_normal'            => 'none',
				'radius'                   => 'normal',
				'post_title_position'      => 'outside',
				'post_show_readingtime'    => '1',
				'post_show_image'          => '1',
				'post_show_excerpt'        => '1',
				'post_show_date'           => 'relative',
				'post_show_author'         => '1',
				'link_color_post_title'    => 'light',
				'link_color'               => 'light',
				'key'                      => 'blog',
				'image_mask'               => 'hexagon-2',
				'height'                   => 'fullscreen',
				'heading_position'         => 'center',
				'heading'                  => $_title,
				'effect'                   => 'none',
				'coverratio'               => '1:1',
				'count'                    => 3,
				'color_text'               => '#333333',
				'color_heading'            => '#ffffff',
				'btn_viewall_check'        => 1,
				'btn_viewall'              => T_("View all"),
				'background_pack'          => 'solid',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#1663a9',
				'background_gradient_from' => '#0ff53b',
				'background_color'         => '#8fa2a6',
			]
		];
	}


	public static function p9($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Card"),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b2',
				'radius_normal'            => 'none',
				'radius'                   => 'normal',
				'post_title_position'      => 'hide',
				'post_show_readingtime'    => '1',
				'post_show_image'          => '1',
				'post_show_excerpt'        => '1',
				'post_show_date'           => 'relative',
				'post_show_author'         => '1',
				'link_color_post_title'    => 'light',
				'link_color'               => 'light',
				'key'                      => 'blog',
				'image_mask'               => 'parallelogram',
				'height'                   => 'fullscreen',
				'heading_position'         => 'center',
				'heading'                  => null,
				'effect'                   => 'none',
				'coverratio'               => '1:1',
				'count'                    => 3,
				'color_text'               => '#333333',
				'color_heading'            => '#ffffff',
				'btn_viewall_check'        => 1,
				'btn_viewall'              => T_("View all"),
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#e6a691',
				'background_gradient_from' => '#915118',
				'background_color'         => '#8fa2a6',
			]
		];
	}


	public static function p10($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Card"),
			'version'        => 1,
			'options' =>
			[
				'type'                     => 'b2',
				'radius_normal'            => 'none',
				'radius'                   => 'normal',
				'post_title_position'      => 'outside',
				'post_show_readingtime'    => '1',
				'post_show_image'          => '1',
				'post_show_excerpt'        => '1',
				'post_show_date'           => 'relative',
				'post_show_author'         => '1',
				'link_color_post_title'    => 'light',
				'link_color'               => 'light',
				'key'                      => 'blog',
				'image_mask'               => 'parallelogram-4',
				'height'                   => 'fullscreen',
				'heading_position'         => 'center',
				'heading'                  => $_title,
				'effect'                   => 'dark',
				'coverratio'               => '1:1',
				'count'                    => 4,
				'color_text'               => '#333333',
				'color_heading'            => '#ffffff',
				'btn_viewall_check'        => 1,
				'btn_viewall'              => T_("View all"),
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom right',
				'background_gradient_to'   => '#674c4b',
				'background_gradient_from' => '#1f1004',
				'background_color'         => '#8fa2a6',
			]
		];
	}


	public static function p11($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Card"),
			'version'        => 1,
			'options' =>
			[

			]
		];
	}


	public static function p12($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Card"),
			'version'        => 1,
			'options' =>
			[

			]
		];
	}

}
?>