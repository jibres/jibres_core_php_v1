<?php
namespace content_site\body\application;


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
			'group'   => T_("Application"),
			'section' => 'application',
			'title'   => T_("Application"),
			'icon'    => \dash\utility\icon::url('Apps'),
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
			'application1',

		];

	}


	public static function popular()
	{
		return
		[
			'application1:p1',
		];
	}




}
?>