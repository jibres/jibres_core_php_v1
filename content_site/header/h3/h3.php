<?php
namespace content_site\header\h3;


class h3
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
			'default'      => ['type' => 'h3'],
			'options'      =>
			[
				'heading_raw',
				'file_header_logo',
				'menu_1',
				// 'style' =>
				// [
					// 'type',
				// ]

			],

			'preview_list' =>
			[
				'p1',
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


}
?>