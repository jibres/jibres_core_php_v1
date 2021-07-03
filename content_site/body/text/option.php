<?php
namespace content_site\body\text;


class option
{

	/**
	 * Call when publish the page
	 *
	 * @return     bool  ( description_of_the_return_value )
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
	 * Get type list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function type_list()
	{
		return
		[
			[
				'group'   => T_("Text"),
				'key'     => 'text',
				'type'   => 'type_1',
				'title'   => T_("Style 1"),
				'icon'    => \dash\utility\icon::url('TextBlock'),
				'default' => true
			],
			[
				'group'   => T_("Text"),
				'key'     => 'text',
				'type'   => 'type_2',
				'title'   => T_("Image with text"),
				'icon'    => \dash\utility\icon::url('TextBlock'),
				'default' => false
			],
		];
	}



	/**
	 * Get current option by check type
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option($_mode = null)
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();

		$type = null;

		if(isset($currentSectionDetail['preview']['type']) && $currentSectionDetail['preview']['type'])
		{
			$type = $currentSectionDetail['preview']['type'];
		}
		else
		{
			// Hey! if change this variable you must change the default type in type_list function
			$type = 'type_1';
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
	public static function type_1()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Modern View"),
			'default' => self::master_default(['type' => __FUNCTION__]),
			'options' => self::master_option(),
		];
	}


	/**
	 * Style 2
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function type_2()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Slider View"),
			'premium' => true,
			'default' => self::master_default(['type' => __FUNCTION__]),
			'options' => self::master_option(),
		];
	}

}
?>