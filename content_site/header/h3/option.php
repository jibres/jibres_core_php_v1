<?php
namespace content_site\header\h3;


class option
{


	/**
	 * Call when publish the page
	 *
	 * @return     <type>  ( description_of_the_return_value )
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
			'group'   => T_("Header"),
			'section'     => 'h3',
			'title'   => T_("Header 3"),
			'icon'    => \dash\utility\icon::url('Header'),
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
			'h3',
		];

	}


	public static function popular()
	{
		return
		[
			'h3:p1',
		];
	}





}
?>