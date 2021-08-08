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
			'title'        => T_("Classic View"),
			'default'      => option::master_default(['type' => 'b1']),
			'options'      => option::master_option(),
			'preview_list' =>
			[
				'p1',
				'p2'
			],
		];
	}


	/**
	 * Preview 1
	 */
	public static function p1()
	{
		return
		[
			'preview_title'  => T_("Card"),
			'preview_image'  => \dash\sample\img::background(),
			'version'        => 1,
		];
	}


	/**
	 * Preview 2
	 */
	public static function p2()
	{
		return
		[
			'preview_title'  => T_("Card 2"),
			'version'        => 2,
		];
	}


}
?>