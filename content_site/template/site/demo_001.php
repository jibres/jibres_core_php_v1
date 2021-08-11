<?php
namespace content_site\template\site;


class demo_001
{
	public static function detail()
	{
		return
		[
			'key'   => 'demo_001',
			'title' => T_("Demo 001"),
			'image' => \dash\sample\img::background(),
		];
	}

	public static function records()
	{
		return
		[
			[
				'mode' => 'body',
				'preview' =>
				[
					'heading'               => T_("Latest Posts"),
					'post_template'         => 'video',
					'post_order'            => 'latest',
					'count'                 => 3,
					'post_show_excerpt'     => true,
					'post_show_image'       => true,
					'post_show_date'        => 'relative',
					'post_show_author'      => true,
					'post_show_readingtime' => true,
					'btn_viewall_check'     => true,
					'btn_viewall'           => T_("View all"),
					'background_pack'       => 'none',
					'height'                => 'm',
					'coverratio'            => '16:9',
					'color_text'            => '#333333',
					'heading_position'      => 'center',
					'type'                  => 'b1',
					'key'                   => 'blog',
					'post_play_item'        => null
				],
			],
			[
				'mode' => 'body',
				'preview' =>
				[
					'heading'               => T_("Latest Posts"),
					'post_template'         => 'video',
					'post_order'            => 'latest',
					'count'                 => 3,
					'post_show_excerpt'     => true,
					'post_show_image'       => true,
					'post_show_date'        => 'relative',
					'post_show_author'      => true,
					'post_show_readingtime' => true,
					'btn_viewall_check'     => true,
					'btn_viewall'           => T_("View all"),
					'background_pack'       => 'none',
					'height'                => 'm',
					'coverratio'            => '16:9',
					'color_text'            => '#333333',
					'heading_position'      => 'center',
					'type'                  => 'b1',
					'key'                   => 'blog',
					'post_play_item'        => null
				],
			],
		];
	}
}
?>