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
			'title'        => T_("Head line 1"),
			'default'      =>
			[
				'model'             => 'headline1',
				'heading'          => T_("Head line"),
				'height'           => 'fullscreen',
				'background_pack'  => 'image',
				'background_image' => \dash\url::cdn(). '/business/comingsoon-1/img/jibres-soon-1.jpg',
			],
			'options'      =>
			[

				'heading_raw',
				'description',
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