<?php
namespace content_site\body\text;


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
			'group'   => T_("Text"),
			'section'     => 'text',
			'title'   => T_("Text box"),
			'icon'    => \dash\utility\icon::url('Text'),
		];
	}




	/**
	 * Get type list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function model_list()
	{
		return
		[
			't1',
		];
	}


	public static function popular()
	{
		return
		[
			't1:p1',

		];
	}

}
?>