<?php
namespace content_site\body\headline;


class headline1
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
			'title'   => T_("Head line 1"),
			'options' =>
			[

				'heading_raw',
				'description',


				// 'image_list2' =>
				// [
				// 	'file',
				// 	'title',
				// 	'image_remove2'
				// ],
				// 'image_add2',

				'style' => \content_site\utility::set_style_option(
				[
					'font',
					'background_effect',
					'background_pack',
					'color_heading',
					'color_text',
				]),
				'spacing' =>
				[
					'height',
					'padding_top',
					'padding_bottom',
					'container_align',
					'container_justify',
				],
				'responsive' =>
				[
					'responsive_device',
				],
			],
			'default'      =>
			[

				'use_as_description' => null,
				'height'             => 'fullscreen',
				'heading'            => T_("Head line"),
				'container_justify'  => 'left',
				'container_align'    => 'end',
				'color_text'         => '#ffffff',
				'color_heading'      => '#ffffff',

				'background_effect'  => 'mesh',

				'heading'          => T_("Head line"),
				'height'           => 'fullscreen',
				'background_pack'  => 'image',
				'background_image' => \dash\url::cdn(). '/business/comingsoon-1/img/jibres-soon-1.jpg',
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
	 * @date 2022-07-13 19:03:34
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/headline/headline1.php
	 * body / headline / headline1 / p1
	 *
	*/
	public static function p1()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'use_as_description' => null,
				'height'             => 'fullscreen',
				'heading'            => T_("Coming Soon"),
				'container_justify'  => 'left',
				'container_align'    => 'end',
				'color_text'         => '#ffffff',
				'color_heading'      => '#ffffff',
				'background_pack'    => 'image',
				'background_image'   => \dash\url::cdn(). '/business/comingsoon-1/img/jibres-soon-1.jpg',
				'background_effect'  => 'mesh',
			],
		];
	}
	// path content_site/body/headline/headline1.php
	// body / headline / headline1 / p1

}
?>