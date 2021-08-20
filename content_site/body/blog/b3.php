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
			'default'      => option::master_default(['type' => 'b3']),
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

				'post_show_read_more',

				'btn_viewall',

				// sub page
				'style' => \content_site\options\style::option_list(
				[
					'height',
					'background_pack',
					'color_heading',
					'color_text',
					'font',
					'btn_viewall_mode',
					'link_color_post_read_more',
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