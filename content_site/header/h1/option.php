<?php
namespace content_site\header\h1;


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
			'section'     => 'h1',
			'title'   => T_("Header 1"),
			'icon'    => \dash\utility\icon::url('Header'),
		];
	}



	/**
	 * Get type list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function model_list()
	{
		return
		[
			'h1',
		];

	}


	public static function popular()
	{
		return
		[
			'h1:p1',
		];
	}





}
?>