<?php
namespace content_site\footer;


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
			'section' => 'footer',
			'title'   => T_("Footer"),
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
			'f1',
			'f3',
			'f_rafiei',
			'f_rafiei2',
		];

	}


	public static function popular()
	{
		return
		[
			'f1:p1',
			'f3:p1',
		];
	}





}
?>