<?php
namespace content_site\ganje\imagetext;


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
	 * Get style list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function style_list()
	{
		return
		[
			[
				'group'   => T_("Image"),
				'key'     => 'imagetext',
				'style'   => 'style_imagewithtext',
				'title'   => T_("Image with text"), 
				'icon'    => \dash\utility\icon::url('ImageWithText'),
				'default' => true
			],
			[
				'group'   => T_("Image"),
				'key'     => 'imagetext',
				'style'   => 'style_imagewithtextoverlay',
				'title'   => T_("Image with text"),
				'icon'    => \dash\utility\icon::url('ImageWithTextOverlay'),
				'default' => false
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
			$style = 'style_imagetext';
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
	 * Fill by sample image
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	private static function default_image_list()
	{
		return
		[
			[
				"index"     => \content_site\options\addimage::generate_random_key(),
				"image"     => null,
				"alt"       => T_("Image"),
				"isdefault" => true,
			],
			[
				"index"     => \content_site\options\addimage::generate_random_key(),
				"image"     => null,
				"alt"       => T_("Image"),
				"isdefault" => true,
			],
			[
				"index"     => \content_site\options\addimage::generate_random_key(),
				"image"     => null,
				"alt"       => T_("Image"),
				"isdefault" => true,
			],
		];
	}



	private static function style_imagetext()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Gallery"),
			'default' =>
			[
				'heading'   => T_("Image Gallery"),
				'style'     => __FUNCTION__,
				'imagelist' => self::default_image_list(),
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
				'heading'   => T_("Slide show"),
				'style'     => __FUNCTION__,
				'imagelist' => self::default_image_list(),
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
				'heading'   => T_("Logo list"),
				'style'     => __FUNCTION__,
				'imagelist' => self::default_image_list(),
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