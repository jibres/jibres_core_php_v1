<?php
namespace content_site\body\blog;


class b1
{

	/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option()
	{
		return
		[
			'title'        => T_("Card Design"),
			'default'      => option::master_default(['type' => 'b1']),
			'options'      => option::master_option(),
			'preview_list' =>
			[
				'p1',
			],
		];
	}


	/**
	 * Preview 1
	 */
	public static function p1($_title = null)
	{
		$_title = T_("Latest Posts");
		return
		[
			'preview_title'  => T_("Preview :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[
				'type'                  => 'b1',
				'post_template'         => 'any',
				'post_tag'              => 'R',
				'post_show_readingtime' => '1',
				'post_show_image'       => '1',
				'post_show_excerpt'     => '1',
				'post_show_date'        => 'relative',
				'post_show_author'      => '1',
				'post_order'            => 'latest',
				'key'                   => 'blog',
				'height'                => 'm',
				'heading_position'      => 'center',
				'heading'               => $_title,
				'coverratio'            => '16:9',
				'count'                 => 3,
				'color_text'            => '#333333',
				'btn_viewall_check'     => '1',
				'btn_viewall'           => T_('View all'),
				'background_pack'       => 'none',
			],
		];
	}




}
?>