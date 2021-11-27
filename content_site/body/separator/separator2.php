<?php
namespace content_site\body\separator;


class separator2
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
			'title'        => T_("Separator 1"),
			'options'      =>
			[
				'separator_icon',
				'height_separator',
				'color',
				'style' => \content_site\utility::set_style_option(
				[
					'background_pack',
				]),
				'spacing' =>
				[
					'container_separator',
					'padding_top',
					'padding_bottom',
				],
				'responsive' => \content_site\utility::set_responsive_option(),
			],
			'default'      =>
			[

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
			'version'        => 1,
			'options' =>
			[


			],
		];
	}



}
?>