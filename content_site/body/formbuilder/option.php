<?php
namespace content_site\body\formbuilder;


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
			'group'   => T_("Form builder"),
			'section' => 'formbuilder',
			'title'   => T_("Form builder"),
			'icon'    => \dash\utility\icon::url('forms', 'major'),
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
			'formbuilder1',

		];

	}


	public static function popular()
	{
		return
		[
			'formbuilder1:p1',
		];
	}




}
?>