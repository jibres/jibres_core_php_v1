<?php
namespace content_site\footer\f1;


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
			'key'     => 'f1',
			'title'   => T_("Footer 3"),
			'icon'    => \dash\utility\icon::url('Footer'),
		];
	}



	/**
	 * Get type list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function type_list()
	{
		return
		[
			'f1',
		];

	}


	public static function popular()
	{
		return
		[
			'f1:p1',
		];
	}





}
?>