<?php
namespace content_site\body\slideshow;


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
			'key'     => 'slideshow',
			'title'   => T_("Slide show"),
			'icon'    => \dash\utility\icon::url('Image'),
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
				'type'   => 'type_1',
				'title'   => T_("Slide show"),
				'default' => true
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
	 * Fill by sample image
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function default_image_list()
	{
		return
		[
			[
				"index"     => \content_site\options\image\image_add::generate_random_key(),
				"image"     => null,
				"caption"   => T_("Image"),
				"isdefault" => true,
			],
			[
				"index"     => \content_site\options\image\image_add::generate_random_key(),
				"image"     => null,
				"caption"   => T_("Image"),
				"isdefault" => true,
			],
			[
				"index"     => \content_site\options\image\image_add::generate_random_key(),
				"image"     => null,
				"caption"   => T_("Image"),
				"isdefault" => true,
			],
		];
	}



	public static function type_1()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Slide show"),
			'default' =>
			[
				'heading'    => T_("Image Slide show"),
				'type'      => __FUNCTION__,
				'image_list' => self::default_image_list(),
			],
			'options' =>
			[
				'image_list' =>
				[
					'file',
					'caption',
					'link',
					'target',
				],
				'image_add',

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