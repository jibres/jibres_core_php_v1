<?php
namespace content_site\h\h1;


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
	 * Get style list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function style_list()
	{
		return
		[
			[
				'group'   => T_("Header"),
				'key'     => 'h1',
				'style'   => 'style_1',
				'title'   => T_("Header 1"),
				'icon'    => \dash\utility\icon::url('Header'),
				'default' => true
			],
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
	private static function style_1()
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