<?php
namespace content_site\body\blog;


class b2
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
			'title'        => T_("Box Design"),
			'default'      => option::master_default(['type' => 'b2']),
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
			'preview_title'  => T_("Preview :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[

			],
		];
	}


	/**
	 * Preview 2
	 */
	public static function p2()
	{
		return
		[
			'preview_title'  => T_("Preview :val", ['val' => \dash\fit::number(1)]),
			'version'        => 2,
		];
	}


}
?>