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
			'title'        => T_("Modern View"),
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


				'post_show_readingtime',
				'post_show_excerpt',


				'btn_viewall',
				'post_show_date',

				// sub page
				'style' => \content_site\options\style::option_list(
				[
					'background_pack',

					'height',


					// skip draw this option in html
					'background_color',

					'background_position',
					'background_repeat',
					'background_size',
					'background_attachment',

					'background_image',

					'background_gradient',
					'background_gradient_type',

					'background_gradient_from',
					'background_gradient_via',
					'background_gradient_to',

					'background_gradient_attachment',
					'background_color_random',

					'color_text',

					'font',
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