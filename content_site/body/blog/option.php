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
			'group'   => T_("Blog post"),
			'key'     => 'blog',
			'title'   => T_("Blog post"),
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
			[
				'type'   => 'b1',
				'title'   => T_("Classic blog"),
				'default' => true
			],
			[
				'type'   => 'b2',
				'title'   => T_("Modern blog"),
				'default' => false
			],
			[
				'type'   => 'b3',
				'title'   => T_("Simple blog"),
				'default' => false
			],
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

		// var_dump($_data);

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
	private static function master_default($_special_default = [])
	{
		$master_default =
		[
			'heading'           => T_("Blog Posts"),
			'post_template'     => 'standard',
			'count'             => 3,
			'post_show_excerpt' => true,
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
	private static function master_option()
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
			// radio
			'post_show_author',
			'post_show_date',
			'post_show_excerpt',
			'post_show_readingtime',
			'btn_viewall',
			// range
			'count_post',


			// 'group_design',
			// select
			'type',
			'height',

			'coverratio',


			// sub page
			'style' => \content_site\options\background\background_pack::get_pack_option_list(),
		];

		return $option;
	}


	/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function b1()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Classic View"),
			'default' => self::master_default(['type' => __FUNCTION__]),
			'options' => self::master_option(),
		];
	}


	/**
	 * Style 2
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function b2()
	{
		$my_option = self::master_option();

		\content_site\utility::unset_option($my_option, 'coverratio');

		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Modern View"),
			'premium' => true,
			'default' => self::master_default(['type' => __FUNCTION__]),
			'options' => $my_option,
		];
	}


	/**
	 * Style 3
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function b3()
	{
		$my_option = self::master_option();

		\content_site\utility::unset_option($my_option, 'coverratio');

		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Modern View"),
			'premium' => true,
			'default' => self::master_default(['type' => __FUNCTION__]),
			'options' => $my_option,
		];
	}

}
?>