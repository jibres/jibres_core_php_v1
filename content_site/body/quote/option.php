<?php
namespace content_site\body\quote;


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
			'group'   => T_("Quote"),
			'section' => 'quote',
			'title'   => T_("Quote"),
			'icon'    => \dash\utility\icon::url('Conversation', 'minor'),
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
			'quote1',

		];

	}


	public static function popular()
	{
		return
		[
			'quote1:p1',
		];
	}




}
?>