<?php
namespace content_site\body\product;


class p1
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
			'options'      =>
			[
				'heading_full',

				'post_tag',
				'post_template',
				'post_order',
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
					'font',
					'height',
					'background_pack',
					'color_heading',
					'radius_normal',
					'coverratio',
					'btn_viewall_mode',
					'type',
				]),
			],
			'default'      =>
			[
				'type'                  => 'p1',
				'heading'               => T_("Latest Posts"),
				'post_template'         => 'any',
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
				'btn_viewall_mode'      => 'dark',
				'radius_normal'         => 'none',
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
			'preview_title'  => T_("Card Design"). ' - '. T_("Sample :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[
				'key'                   => 'product',
				'type'                  => 'p1',
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
				'radius'                => 'lg',
				'btn_viewall_check'     => 1,
				'btn_viewall'           => T_('View all'),
				'background_pack'       => 'none',
			],
		];
	}
}
?>