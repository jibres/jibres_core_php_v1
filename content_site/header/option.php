<?php
namespace content_site\header;


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
			'section' => 'header',
			'title'   => T_("Header"),
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
			'h1',
			'h3',
			'h_rafiei',
			'h_rafiei2',
		];

	}


	public static function popular()
	{
		return
		[
			'h1:p1',
			'h3:p1',
		];
	}





}
?>