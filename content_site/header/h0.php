<?php
namespace content_site\header;


class h0
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
			'title'        => T_("Empty"),
			'default'      => [],
			'options'      =>
			[
				'msg' => 'my_msg',
				'responsive' => \content_site\utility::set_responsive_option_header(),
			],

			'preview_list' =>
			[
				'p1',
			],
		];
	}


	public static function my_msg()
	{
		return \content_site\options\generate::msg(T_("This header is emtpy. Have not any option!"));
	}


	/**
	 * Preview 1
	 */
	public static function p1()
	{
		return
		[
			// 'preview_title' => T_("Without header"),
			'version'        => 1,
			'options' =>
			[

			],
		];
	}


}
?>