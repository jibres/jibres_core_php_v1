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
			'title'        => T_("Gradient"),
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
				'responsive' =>
				[
					'responsive_device',
				],
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



	/**
	 * Auto Generate Function
	 * @date 2022-07-13 19:14:40
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/separator/separator2.php
	 * body / separator / separator2 / p1
	 *
	*/
	public static function p1()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
			],
		];
	}
	// path content_site/body/separator/separator2.php
	// body / separator / separator2 / p1

}
?>