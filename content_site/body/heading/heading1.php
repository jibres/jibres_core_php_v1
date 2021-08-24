<?php
namespace content_site\body\heading;


class heading1
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
			'title'        => T_("Gallery 1"),
			'default'      =>
			[
				'type'             => 'heading1',
				'heading'          => T_("Heading"),
				'height'           => 'fullscreen',
				'background_pack'  => 'image',
				'background_image' => \dash\url::cdn(). '/business/comingsoon-1/img/jibres-soon-1.jpg',
			],
			'options'      =>
			[

				'heading_raw',
				'description',
				'style' => \content_site\options\style::option_list(
				[
					'font',
					'height',

					'background_pack',
					'color_heading',

					'type',
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
			'preview_title'  => T_("Preview :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[

			],
		];
	}



}
?>