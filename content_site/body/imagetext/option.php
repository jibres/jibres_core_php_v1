<?php
namespace content_site\body\imagetext;


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
			'group'   => T_("Image"),
			'section' => 'imagetext',
			'title'   => T_("Image With Text"),
			'icon'    => \dash\utility\icon::url('ImageWithText', 'major'),
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
			'imagetext1',

		];

	}


	public static function popular()
	{
		return
		[
			'imagetext1:p1',
		];
	}




}
?>