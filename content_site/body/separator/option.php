<?php
namespace content_site\body\separator;


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
			'section' => 'separator',
			'title'   => T_("Separator"),
			'icon'    => \dash\utility\icon::url('MobileHorizontalDots'),
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
			'separator1',
			'separator2',
			'separatorSVG',

		];

	}


	public static function popular()
	{
		return
		[
			'separator1:p1',
		];
	}




}
?>