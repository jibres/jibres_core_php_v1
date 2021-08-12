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
	 * Get type list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function type_list()
	{
		return
		[
			'g1',
		];

	}


	public static function popular()
	{
		return
		[
			'g1:p1',
		];
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




	/**
	 * Public default
	 */
	public static function master_default($_special_default = [])
	{
		$master_default =
		[
			'heading'           => T_("Image Gallery"),
			'image_list' => self::default_image_list()

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
	public static function master_option()
	{
		$option =
		[

			'heading',

			'image_list' =>
			[
				'file_gallery',
				'caption',
				'link',
				'target',
			],
			'image_add',
			// sub page
			'style' => \content_site\options\background\background_pack::get_pack_option_list(),
		];

		return $option;
	}


}
?>