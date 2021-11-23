<?php
namespace content_site\body\socialnetwork;


class option
{

	/**
	 * Call when publish the page
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function premium()
	{
		return !\dash\url::isLocal();
	}


	public static function is_private()
	{
		return !\dash\url::isLocal();
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
			'group'   => T_("Social Networks"),
			'section' => 'socialnetwork',
			'title'   => T_("Social Networks"),
			'icon'    => \dash\utility\icon::url('ThumbsUp'),
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
			'socialnetwork1',

		];

	}


	public static function popular()
	{
		return
		[
			'socialnetwork1:p1',
		];
	}




}
?>