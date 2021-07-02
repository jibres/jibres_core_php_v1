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
	 * Get detail
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function detail()
	{
		return
		[
			'group'   => T_("Image"),
			'key'     => 'gallery',
			'title'   => T_("Gallery"),
			'icon'    => \dash\utility\icon::url('Image'),
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
				'title'   => T_("Gallery"),
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
	 * Fill by sample image
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function default_image_list()
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



	public static function style_1()
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

}
?>