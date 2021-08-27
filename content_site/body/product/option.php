<?php
namespace content_site\body\product;


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
			'group'   => T_("Products"),
			'section'     => 'product',
			'title'   => T_("Products"),
			'icon'    => \dash\utility\icon::url('Products'),
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
			'p3',
			// 'p1',
			// 'p2',
		];
	}


	public static function popular()
	{
		return
		[
			'p3:p1',
			// 'p1:p1',
			// 'p2:p1',
		];
	}

}
?>