<?php
namespace content_site\body\imagetext;


class imagetext1
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
			'title'        => null,
			'options'      =>
			[
				'file',
				'reverse',
				'text' =>
				[
					'text'
				],
				'text_link',
				// sub page
				'style' => \content_site\utility::set_style_option(
				[
					'background_pack',
					'image_mask',
					'coverratio',
					'radius_full',
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

				'background_pack' => 'none',
				'height'          => 'md',
				'coverratio'      => '16:9',

				'radius'          => '3xl',

				'file'            => \dash\sample\img::background(),
				'html_text'       => T_("Your text"),
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



	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:59:11
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/imagetext/imagetext1.php
	 * body / imagetext / imagetext1 / p1
	 *
	*/
	public static function p1()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'          => '3xl',
				'html_text'       => T_("Your text"),
				'height'          => 'md',
				'file'            => \dash\sample\img::background(),
				'coverratio'      => '16:9',
				'background_pack' => 'none',
			],
		];
	}
	// path content_site/body/imagetext/imagetext1.php
	// body / imagetext / imagetext1 / p1

}
?>