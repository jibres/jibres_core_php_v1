<?php
namespace content_site\body\contactform;


class option
{

	public static function router()
	{
		\dash\allow::html();
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
			'group'   => T_("Contact"),
			'key'     => 'contactform',
			'title'   => T_("Contact Form"),
			'icon'    => \dash\utility\icon::url('Forms'),
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
			'cf1',

		];

	}


	public static function popular()
	{
		return
		[
			'cf1:p1',
		];
	}




}
?>