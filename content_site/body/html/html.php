<?php
namespace content_site\body\html;


class html
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
			'title'        => T_("HTML"),
			'default'      => ['model' => 'html', 'heading' => T_("Raw HTML")],
			'options'      =>
			[
				'heading_raw',
				'html',
				'responsive' =>
				[
					'responsive_device',
				],
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