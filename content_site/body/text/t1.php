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
				'html_editor',

				// sub page
				'style' => \content_site\options\style::option_list(
				[
					'font',
					'height',
					'container',
					'background_pack',
					'type',
				]),
			],
			'default'      =>
			[
				'type'                  => 't1',
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
			'preview_title'  => T_('Text box'). ' - '. T_("Sample :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[

			],
		];
	}

}
?>