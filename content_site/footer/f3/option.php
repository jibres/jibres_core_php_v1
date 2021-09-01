<?php
namespace content_site\footer\f3;


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
			'group'   => T_("Footer"),
			'section'     => 'f3',
			'title'   => T_("Footer 3"),
			'icon'    => \dash\utility\icon::url('Footer'),
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
			'f3',
		];

	}


	public static function popular()
	{
		return
		[
			'f3:p1',
		];
	}





}
?>