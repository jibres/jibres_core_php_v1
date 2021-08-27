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
			'section'     => 'blog',
			'title'   => T_("Posts"),
			'icon'    => \dash\utility\icon::url('Blog'),
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
			'b1',
			'b2',
			'b3',
		];
	}


	public static function popular()
	{
		return
		[
			'b1:p2',
			'b2:p1',
			'b2:p9',
			'b1:p1',
			'b3:p2',
			'b1:p6',
			'b2:p3',
			'b1:p4',
			'b2:p4',
			'b2:p7',
			'b1:p8',
			'b2:p12',
		];
	}

}
?>