<?php
namespace content_site\header\h0;


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
			'section' => 'h0',
			'title'   => T_("Without header"),
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
			'h0',
		];

	}


	public static function popular()
	{
		return
		[
			'h0:p1',
		];
	}





}
?>