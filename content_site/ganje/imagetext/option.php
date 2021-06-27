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
				'title'   => T_("Image with text overlay"),
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
			$style = 'style_imagewithtext';
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



	private static function style_imagewithtext()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Image with text"),
			'default' =>
			[
				'heading' => T_("Image with text"),
				'style'   => __FUNCTION__,
				'file'    => \dash\utility\icon::url('ImageWithText'),
				'text'    => T_("Pair large text with an image to give focus to your chosen product, collection, or blog post. Add details on availability, style, or even provide a review."),
			],
			'options' =>
			[
				'file',
				'heading',
				'text',
				'container',
				'height',
				'style',
			],
		];
	}


	private static function style_imagewithtextoverlay()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Image with text overlay"),
			'default' =>
			[
				'heading'   => T_("Image with text overlay"),
				'style'     => __FUNCTION__,
				'imagelist' => \dash\utility\icon::url('ImageWithTextOverlay'),
				'text'      => T_("Use overlay text to give your customers insight into your brand. Select imagery and text that relates to your style and story."),
			],
			'options' =>
			[
				'file',
				'heading',
				'text',
				'container',
				'height',
				'style',
			],
		];
	}

}
?>