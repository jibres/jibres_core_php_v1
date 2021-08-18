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

		$master_option =
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
			'post_show_read_more',

			'btn_viewall',
			'post_show_date',

			// sub page
			'style' => \content_site\options\style::option_list('blog'),

		];

		\content_site\options\background\background_pack::remove_from_list('coverratio');

		return
		[
			'title'        => T_("Modern View"),
			'default'      => option::master_default(['type' => 'b3']),
			'options'      => $master_option,
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