<?php
namespace content_site\body\quote;


class quote1
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
			'title'        => T_("Quote 1"),
			'options'      =>
			[
				'heading',
				'quote_list' =>
				[
					'quote_title',
					'quote_displayname',
					'quote_text',
					'quote_job',
					'file_avatar',
					'quote_remove',
				],
				'quote_add',
				'quote_random',

				'style' => \content_site\utility::set_style_option(
				[
					'font',
					'background_pack',
					'justify_heading',
					'heading_size',
				]),
				'spacing' =>
				[
					'height',
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
				'heading'          => T_("quote"),
				'height'           => 'auto',
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
	 * @date 2022-07-13 19:06:01
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/quote/quote1.php
	 * body / quote / quote1 / p1
	 *
	*/
	public static function p1()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'height'  => 'auto',
				'heading' => T_("quote"),
			],
		];
	}
	// path content_site/body/quote/quote1.php
	// body / quote / quote1 / p1
}
?>