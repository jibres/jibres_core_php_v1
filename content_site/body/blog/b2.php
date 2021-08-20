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
			'default'      => option::master_default(['type' => 'b2', 'post_title_position' => 'inside']),
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
				'btn_viewall',




				// sub page
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