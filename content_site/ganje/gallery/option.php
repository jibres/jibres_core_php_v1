<?php
namespace content_site\ganje\gallery;


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
			'group' => T_("Image"),
			'title' => T_("Gallery"),
			'key'   => 'gallery',
			'icon'  => \dash\utility\icon::url('images'),
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
			['key' => 'style_gallery', 		'title' => T_("Gallery"), 'default' => true],
			['key' => 'style_slideshow', 	'title' => T_("Slide show"), 'default' => false,],
			['key' => 'style_logolist', 	'title' => T_("Logo list"), 'default' => false,],
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
			$style = 'style_gallery';
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



	private static function style_gallery()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Gallery"),
			'default' =>
			[
				'heading' => T_("Image Gallery"),
				'style'   => __FUNCTION__,
			],
			'options' =>
			[
				'imagelist' =>
				[
					'file',
					'caption',
					'link',
					'target',
				],
				'addimage',

				'seperator', /* SEPERATOR */

				'style',
				'heading',
				'container',
				'height',
				'ratio',
			],
		];
	}


	private static function style_slideshow()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Slide show"),
			'default' =>
			[
				'heading' => T_("Slide show"),
				'style'   => __FUNCTION__,
			],
			'options' =>
			[
				'imagelist' =>
				[
					'file',
					'caption',
					'link',
					'target',
				],
				'addimage',

				'seperator', /* SEPERATOR */

				'style',
				'heading',
				'container',
				'height',
				'ratio',
			],
		];
	}


	private static function style_logolist()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Logo list"),
			'default' =>
			[
				'heading' => T_("Logo list"),
				'style'   => __FUNCTION__,
			],
			'options' =>
			[
				'imagelist' =>
				[
					'file',
					'caption',
					'link',
					'target',
				],
				'addimage',

				'seperator', /* SEPERATOR */

				'style',
				'heading',
				'container',
				'height',
				'ratio',
			],
		];
	}
}
?>