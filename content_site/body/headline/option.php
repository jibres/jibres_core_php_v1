<?php
namespace content_site\body\headline;


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
			'group'   => T_("Headline"),
			'section'     => 'headline',
			'title'   => T_("Headline"),
			'icon'    => \dash\utility\icon::url('ImageWithTextOverlay'),
		];
	}



	/**
	 * Get model list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function model_list()
	{
		return
		[
			'headline1',

		];

	}


	public static function popular()
	{
		return
		[
			'headline1:p1',
		];
	}




}
?>