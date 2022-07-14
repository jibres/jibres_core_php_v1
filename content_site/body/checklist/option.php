<?php
namespace content_site\body\checklist;


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
			'group'   => T_("Checklist"),
			'section' => 'checklist',
			'title'   => T_("Checklist"),
			'icon'    => \dash\utility\icon::url('Checklist'),
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
			'checklist1',

		];

	}


	public static function popular()
	{
		return
		[
			'checklist1:p1',
		];
	}




}
?>