<?php
namespace content_site\header\h1;


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
			'group'   => T_("Header"),
			'key'     => 'h1',
			'title'   => T_("Header 1"),
			'icon'    => \dash\utility\icon::url('Header'),
		];
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
			[
				'style'   => 'style_1',
				'title'   => T_("Header 1"),
				'default' => true
			],
		];

	}



	/**
	 * Get current option by check style
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option($_data, $_mode = null)
	{

		$style = null;

		if(isset($_data['preview']['style']) && $_data['preview']['style'])
		{
			$style = $_data['preview']['style'];
		}
		else
		{
			// Hey! if change this variable you must change the default style in style_list function
			$style = 'style_1';
		}

		$style_detail = [];

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
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function style_1()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Header 1"),
			'default' =>
			[
				'heading' => \lib\store::title(),
			],
			'options' =>
			[
				'heading',
			],
		];
	}



}
?>