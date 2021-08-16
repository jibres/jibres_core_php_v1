<?php
namespace content_site\body\blog;


class b4
{


	/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option()
	{
		\content_site\options\background\background_pack::remove_from_list('coverratio');

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
			'post_show_author',
			'post_show_comment_count',

			'btn_viewall',

			// sub page
			'style' => \content_site\options\background\background_pack::get_pack_option_list(),

		];

		return
		[
			'title'        => T_("Modern View"),
			'default'      => option::master_default(['type' => 'b4']),
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