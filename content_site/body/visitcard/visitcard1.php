<?php
namespace content_site\body\visitcard;


class visitcard1
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
			'title'        => T_("visitcard 1"),
			'options'      =>
			[
				'heading_raw',
				'description',

				''

				'style' => \content_site\utility::set_style_option(
				[
					'font',

					'height',

					'background_pack',

				]
				),
			],
			'default'      =>
			[
				'heading'          => T_("visitcard"),
				'height'           => 'fullscreen',
			],
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
			'version'        => 1,
			'options' =>
			[

			],
		];
	}



}
?>