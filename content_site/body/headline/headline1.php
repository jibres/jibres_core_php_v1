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
					'height',

					'background_pack',
					'color_heading',

					'model',
				]
				),
			],
			'default'      =>
			[
				'model'             => 'headline1',
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