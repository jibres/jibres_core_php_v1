<?php
namespace content_site\body\imagetext;


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
	 * Get type list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function type_list()
	{
		return
		[
			[
				'group'   => T_("Image"),
				'key'     => 'imagetext',
				'type'   => 'type_imagewithtext',
				'title'   => T_("Image with text"), 
				'icon'    => \dash\utility\icon::url('ImageWithText'),
				'default' => true
			],
			[
				'group'   => T_("Image"),
				'key'     => 'imagetext',
				'type'   => 'type_imagewithtextoverlay',
				'title'   => T_("Image with text overlay"),
				'icon'    => \dash\utility\icon::url('ImageWithTextOverlay'),
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
			$type = 'type_imagewithtext';
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



	public static function type_imagewithtext()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Image with text"),
			'default' =>
			[
				'heading' => T_("Image with text"),
				'type'   => __FUNCTION__,
				'file'    => \dash\utility\icon::url('ImageWithText'),
				'text'    => T_("Pair large text with an image to give focus to your chosen product, collection, or blog post. Add details on availability, type, or even provide a review."),
			],
			'options' =>
			[
				'file',
				'heading',
				'text',
				'container',
				'height',

			],
		];
	}


	public static function type_imagewithtextoverlay()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Image with text overlay"),
			'default' =>
			[
				'heading'   => T_("Image with text overlay"),
				'type'     => __FUNCTION__,
				'imagelist' => \dash\utility\icon::url('ImageWithTextOverlay'),
				'text'      => T_("Use overlay text to give your customers insight into your brand. Select imagery and text that relates to your type and story."),
			],
			'options' =>
			[
				'file',
				'heading',
				'text',
				'container',
				'height',

			],
		];
	}

}
?>