<?php
namespace content_site\ganje\text;


class option
{

	/**
	 * Call when publish the page
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function premium()
	{
		return true;
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
			'group' => T_("Text"),
			'title' => T_("Text"),
			'key'   => 'text',
			'icon'  => \dash\utility\icon::url('TextBlock'),
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
			['key' => 'style_1', 'title' => T_("Modern View"), 'default' => true],
			['key' => 'style_2', 'title' => T_("Slider View"), 'default' => false,],
		];
	}



	/**
	 * Make preview all style list
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function preview_list()
	{
		$list       = [];
		$detail     = self::detail();
		$style_list = self::style_list();

		foreach ($style_list as $key => $value)
		{
			$temp                = $detail;
			$temp['style']       = a($value, 'key');
			$temp['style_title'] = a($value, 'title');
			$list[]              = $temp;
		}

		return $list;

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
			'heading'        => T_("Rich text"),
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
			'file',
			'heading',

			'container',
			'height',

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
			'title'   => T_("Modern View"),
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
			'title'   => T_("Slider View"),
			'premium' => true,
			'default' => self::master_default(['style' => __FUNCTION__]),
			'options' => self::master_option(),
		];
	}

}
?>