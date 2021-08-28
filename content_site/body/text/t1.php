<?php
namespace content_site\body\text;


class t1
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
			'title'        => T_('Text box'),
			'options'      =>
			[
				'heading_raw',
				'text',

				// sub page
				'style' => \content_site\utility::set_style_option(
				[
					'font',
					'height',
					'container',
					'background_pack',
					'color_text',
					'model',
				]),
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
	public static function p1($_title = null)
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