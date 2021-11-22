<?php
namespace content_site\body\title;


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
			'group'   => T_("Title"),
			'section' => 'title',
			'title'   => T_("Title"),
			'icon'    => \dash\utility\icon::url('Type'),
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
			'title1',

		];

	}


	public static function popular()
	{
		return
		[
			'title1:p1',
		];
	}




}
?>