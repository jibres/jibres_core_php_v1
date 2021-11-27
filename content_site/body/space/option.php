<?php
namespace content_site\body\space;


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
			'group'   => T_("Space"),
			'section' => 'space',
			'title'   => T_("Space"),
			'icon'    => \dash\utility\icon::url('square', 'bootstrap'),
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
			'space1',

		];

	}


	public static function popular()
	{
		return
		[
			'space1:p1',
		];
	}




}
?>