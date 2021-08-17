<?php
namespace content_site\body\heading;


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
			'group'   => T_("Heading"),
			'key'     => 'heading',
			'title'   => T_("Heading"),
			'icon'    => \dash\utility\icon::url('ImageWithTextOverlay'),
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
			'heading1',

		];

	}


	public static function popular()
	{
		return
		[
			'heading1:p1',
		];
	}




}
?>