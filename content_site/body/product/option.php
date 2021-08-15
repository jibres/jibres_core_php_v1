<?php
namespace content_site\body\product;


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
			'group'   => T_("Products"),
			'key'     => 'product',
			'title'   => T_("Product"),
			'icon'    => \dash\utility\icon::url('Products'),
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
			'p1',
		];
	}


	public static function popular()
	{
		return
		[
			'p1:p1',
		];
	}



	/**
	 * Public default
	 */
	public static function master_default($_special_default = [])
	{
		$master_default =
		[
			'heading'               => T_("Latest Products"),
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