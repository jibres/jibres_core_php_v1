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
				'heading_full',
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

					'height',

					'background_pack',

				]
				),
			],
			'default'      =>
			[
				'heading'          => T_("quote"),
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