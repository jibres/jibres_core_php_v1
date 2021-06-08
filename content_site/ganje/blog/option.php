<?php
namespace content_site\ganje\blog;


class option
{

	/**
	 * Call when try to add or choose section
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function allow()
	{
		return true;
	}


	/**
	 * Call when publish the page
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function premium()
	{
		return self::allow();
	}


	/**
	 * Get detail
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function detail()
	{
		$detail =
		[
			'group' => T_("Blog"),
			'title' => T_("Blog posts"),
			'key'   => 'blog',
			'icon'  => \dash\utility\icon::url('Blog'),
		];

		return $detail;
	}


	/**
	 * Get style list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function style_list()
	{
		return
		[
			['key' => 'style_1', 'title' => T_("Classic View"), 'default' => true],
			['key' => 'style_2', 'title' => T_("Modern View"), 'default' => false,],
		];
	}


	/**
	 * Get current option by check style
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option($_mode = null)
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();

		$style = null;

		if(isset($currentSectionDetail['preview']['style']) && $currentSectionDetail['preview']['style'])
		{
			$style = $currentSectionDetail['preview']['style'];
		}
		else
		{
			// Hey! if change this variable you must change the default style in style_list function
			$style = 'style_1';
		}

		if(is_callable(['self', $style]))
		{
			$style_detail = call_user_func(['self', $style]);
		}

		// get full option
		if($_mode === 'full')
		{
			return $style_detail;
		}

		if(isset($style_detail['options']))
		{
			return $style_detail['options'];
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
			'heading'        => T_("Post blog"),
			'post_template'  => 'standard',
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
			'style',
			'heading',
			'view_all_btn',

			'post_tag',
			'post_template',
			'post_show_author',
			'post_show_date',

			'limit',
			'container',
			'padding',
			'radius',
		];

		return $option;
	}


	/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	private static function style_1()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Classic View"),
			'default' => self::master_default(['style' => __FUNCTION__]),
			'options' => self::master_option(),
		];
	}


	/**
	 * Style 2
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	private static function style_2()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Modern View"),
			'premium' => true,
			'default' => self::master_default(['style' => __FUNCTION__]),
			'options' => self::master_option(),
		];
	}

}
?>