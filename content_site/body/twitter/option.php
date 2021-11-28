<?php
namespace content_site\body\twitter;


class option
{



	public static function is_private()
	{
		return !\dash\url::isLocal();
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
			'group'   => T_("Social Networks"),
			'section' => 'twitter',
			'title'   => T_("Twitter"),
			'icon'    => \dash\utility\icon::url('twitter', 'bootstrap'),
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
			'twitter1',

		];

	}


	public static function popular()
	{
		return
		[
			'twitter1:p1',
		];
	}




}
?>