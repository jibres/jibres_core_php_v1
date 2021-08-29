<?php
namespace content_site\body\visitcard;


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
			'group'   => T_("Visit card"),
			'section' => 'visitcard',
			'title'   => T_("Visit card"),
			'icon'    => \dash\utility\icon::url('ChecklistAlternate'),
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
			'visitcard1',

		];

	}


	public static function popular()
	{
		return
		[
			'visitcard1:p1',
		];
	}




}
?>