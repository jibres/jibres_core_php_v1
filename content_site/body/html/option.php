<?php
namespace content_site\body\html;


class option
{

	/**
	 * Call when publish the page
	 *
	 * @return     bool  ( description_of_the_return_value )
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
			'group'   => T_("HTML"),
			'key'     => 'html',
			'title'   => T_("HTML"),
			'icon'    => \dash\utility\icon::url('Code'),
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
			'html',

		];

	}


	public static function popular()
	{
		return ['html:p1'];
	}





}
?>