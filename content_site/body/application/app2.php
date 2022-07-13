<?php
namespace content_site\body\application;


class app2
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
			'title'        => T_("Simple"),
			'options'      =>
			[
				'heading',
				'description',
				'msg' => 'manage',


				'style' => \content_site\utility::set_style_option(
				[
					'font',

					'radius_full',
					'background_pack',
					'color_heading',
				]),
				'spacing' =>
				[
					'height',
					'padding_top',
					'padding_bottom',
					'container',
				],
				'responsive' =>
				[
					'responsive_device',
				],
			],
			'default'      =>
			[
				'heading'              => T_("Application"),
				'background_pack'      => 'solid',
				'background_color'     => '#eeeeee',
			],
			'preview_list' =>
			[
				'p1',

			],
		];
	}


	public static function manage()
	{
		return app1::manage();
	}


	/**
	 * Preview 1
	 */



	/**
	 * Auto Generate Function
	 * @date 2022-07-13 19:16:39
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/application/app2.php
	 * body / application / app2 / p1
	 *
	*/
	public static function p1()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'heading'          => null,
				'background_pack'  => 'solid',
				'background_color' => '#eeeeee',
			],
		];
	}
	// path content_site/body/application/app2.php
	// body / application / app2 / p1

}
?>