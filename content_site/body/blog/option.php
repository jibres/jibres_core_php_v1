<?php
namespace content_site\body\blog;


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
			'group'   => T_("CMS"),
			'key'     => 'blog',
			'title'   => T_("Posts"),
			'icon'    => \dash\utility\icon::url('Blog'),
		];
	}




	/**
	 * Get type list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function type_list()
	{
		return
		[
			'b1',
			'b2',
			'b3',
		];
	}


	public static function popular()
	{
		return
		[
			'b1:p1',
			'b2:p1'
		];
	}

}
?>