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
				'count_post',
				'post_show_date',
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
				'type'                  => 'b3',
				'heading'               => T_("Latest Posts"),
				'post_template'         => 'any',
				'post_order'            => 'latest',
				'count'                 => 3,
				'post_show_date'        => 'relative',
				'btn_viewall_check'     => true,
				'btn_viewall'           => T_("View all"),
				'background_pack'       => 'none',
				'height'                => 'm',
				'color_text'            => '#333333',
				'heading_position'      => 'center',
				'btn_viewall_mode'      => 'dark',
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
	public static function p1()
	{
		return
		[
			'preview_title'  => T_("Sample :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
		];
	}


}
?>