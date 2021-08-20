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
			'title'        => T_("Modern View"),
			'default'      => option::master_default(['type' => 'b2']),
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

				'effect',

				'btn_viewall',


				// sub page
				'style' => \content_site\options\style::option_list(
				[

					'height',
					'coverratio',
					'radius',

					'background_pack',

					'color_text',

					'font',

					'btn_viewall_mode',

					'link_color_post_title',


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
			'preview_title'  => T_("Card"),
			'version'        => 1,
		];
	}


}
?>