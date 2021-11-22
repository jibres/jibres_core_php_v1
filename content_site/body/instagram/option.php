<?php
namespace content_site\body\instagram;


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
			'section' => 'instagram',
			'title'   => T_("Instagram"),
			'icon'    => \dash\utility\icon::url('instagram', 'bootstrap'),
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
			'instagram1',

		];

	}


	public static function popular()
	{
		return
		[
			'instagram1:p1',
		];
	}




}
?>