<?php
namespace content_site\footer\f0;


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
			'section'     => 'f0',
			'title'   => T_("Footer 0"),
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
			'f0',
		];

	}


	public static function popular()
	{
		return
		[
			'f0:p1',
		];
	}





}
?>