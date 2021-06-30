<?php
namespace content_site\body\gallery;


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
				'key'     => 'gallery',
				'style'   => 'style_gallery',
				'title'   => T_("Gallery"),
				'icon'    => \dash\utility\icon::url('Image'),
				'default' => true
			],
			[
				'group'   => T_("Image"),
				'key'     => 'gallery',
				'style'   => 'style_slideshow',
				'title'   => T_("Slide show"),
				'icon'    => \dash\utility\icon::url('Image'),
				'default' => false
			],
			[
				'group'   => T_("Image"),
				'key'     => 'gallery',
				'style'   => 'style_logolist',
				'title'   => T_("Logo list"),
				'icon'    => \dash\utility\icon::url('Image'),
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
				"caption"   => T_("Image"),
				"isdefault" => true,
			],
			[
				"index"     => \content_site\options\addimage::generate_random_key(),
				"image"     => null,
				"caption"   => T_("Image"),
				"isdefault" => true,
			],
			[
				"index"     => \content_site\options\addimage::generate_random_key(),
				"image"     => null,
				"caption"   => T_("Image"),
				"isdefault" => true,
			],
		];
	}



	public static function style_gallery()
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

				'heading',
				'container',
				'height',
				'ratio',
			],
		];
	}


	public static function style_slideshow()
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

				'heading',
				'container',
				'height',
				'ratio',
			],
		];
	}


	public static function style_logolist()
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

				'heading',
				'container',
				'height',
				'ratio',
			],
		];
	}
}
?>