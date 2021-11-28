<?php
namespace content_site\body\space;


class option
{

	/**
	 * Get detail
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function detail()
	{
		return
		[
			'group'   => T_("Separator"),
			'section' => 'space',
			'title'   => T_("Free space"),
			'icon'    => \dash\utility\icon::url('square', 'bootstrap'),
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
			'space1',

		];

	}


	public static function popular()
	{
		return
		[
			'space1:p1',
		];
	}




}
?>