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



	/**
	 * Get current option by check type
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option($_data, $_mode = null)
	{
		$type = null;

		if(isset($_data['preview']['type']) && $_data['preview']['type'])
		{
			$type = $_data['preview']['type'];
		}
		else
		{
			// Hey! if change this variable you must change the default type in type_list function
			$type = 'b1';
		}

		$type_detail = [];

		if(is_callable(['self', $type]))
		{
			$type_detail = call_user_func(['self', $type]);
		}

		// get full option
		if($_mode === 'full')
		{
			return $type_detail;
		}

		if(isset($type_detail['options']))
		{
			return $type_detail['options'];
		}

		return [];
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

			'pwa:preview:count'     => 1,
			'preview:heading'       => null,
			'preview:count'         => 2,
			'preview:height'        => 'fullpreview',

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