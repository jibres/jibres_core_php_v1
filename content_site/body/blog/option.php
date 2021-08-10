<?php
namespace content_site\body\blog;


class option
{


	/**
	 * Call when publish the page
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function premium()
	{
		return false;
	}


	/**
	 * Get detail
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function detail()
	{
		return
		[
			'group'   => T_("CMS"),
			'key'     => 'blog',
			'title'   => T_("Posts"),
			'icon'    => \dash\utility\icon::url('Blog'),
		];
	}




	/**
	 * Get type list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function type_list()
	{
		return
		[
			'b1',
			'b2',
			'b3',
			'b4',
			'b5',
			'b6',
		];
	}


	public static function category()
	{
		return
		[
			'popular' => ['slug' => 'p',  'title' => T_("Popular"), 'list' => ['b1:p1', 'b1:p2', 'b2:p1']],
			'b1'      => ['slug' => 'b1', 'title' => T_("Blog 1"),  'list' => ['b1']],
			'b2'      => ['slug' => 'b2', 'title' => T_("Blog 2"),  'list' => ['b2']],
			'b3'      => ['slug' => 'b3', 'title' => T_("Blog 3"),  'list' => ['b3']],
			'b4'      => ['slug' => 'b4', 'title' => T_("Blog 4"),  'list' => ['b4']],
		];
	}



	/**
	 * Public default
	 */
	public static function master_default($_special_default = [])
	{
		$master_default =
		[
			'heading'               => T_("Latest Posts"),
			'post_template'         => 'any',
			'count'                 => 3,

			'post_show_excerpt'     => true,
			'post_show_image'       => true,
			'post_show_date'        => 'relative',
			'post_show_author'      => true,
			'post_show_readingtime' => true,
			'btn_viewall_check'     => true,
		];

		return array_merge($master_default, $_special_default);
	}


	/**
	 * Master option
	 *
	 * @param      array   $_special_default  The special default
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function master_option()
	{
		$option =
		[
			// 'group_setting',
			// text
			'heading',

			// select
			'post_tag',
			'post_template',

			'post_order',
			// range
			'count_post',

			'post_show_image',
			'post_show_readingtime',
			'post_show_excerpt',
			'post_show_author',

			'btn_viewall',
			'post_show_date',

			// sub page
			'style' => \content_site\options\background\background_pack::get_pack_option_list(),

		];

		return $option;
	}

}
?>