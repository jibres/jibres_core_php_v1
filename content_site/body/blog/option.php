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



	/**
	 * Public default
	 */
	public static function master_default($_special_default = [])
	{
		$master_default =
		[
			'heading'               => T_("Latest Posts"),
			'post_template'         => 'any',
			'post_order'            => 'latest',
			'count'                 => 3,
			'post_show_excerpt'     => true,
			'post_show_image'       => true,
			'post_show_date'        => 'relative',
			'post_show_author'      => true,
			'post_show_readingtime' => true,
			'btn_viewall_check'     => true,
			'btn_viewall'           => T_("View all"),
			'background_pack'       => 'none',
			'height'                => 'm',
			'coverratio'            => '16:9',
			'color_text'            => '#333333',
			'heading_position'      => 'center',
			'btn_viewall_mode'      => 'dark',
			'radius_normal'         => 'none',
		];

		return array_merge($master_default, $_special_default);
	}


}
?>