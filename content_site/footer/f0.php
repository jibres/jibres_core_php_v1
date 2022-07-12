<?php
namespace content_site\footer;


class f0
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
			'default'      =>
			[
			],
			'options'      =>
			[
				'msg' => 'my_msg',
			],

			'preview_list' =>
			[
				'p1',
			],
		];
	}


	public static function my_msg()
	{
		return \content_site\options\generate::msg(T_("This footer is emtpy. Have not any option!"));
	}


	/**
	 * Preview 1
	 */
	public static function p1()
	{
		return
		[
			// 'preview_title' => T_("Without footer"),
			'version'        => 1,
			'options' =>
			[
				'use_as_footer_link' => 'none',
			],
		];
	}


}
?>