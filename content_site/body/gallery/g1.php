<?php
namespace content_site\body\gallery;


class g1
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
			'title'        => T_("Magic Gallery box"),
			'default'      => option::master_default(['type' => 'g1', 'effect' => 'zoom', ]),
			'options'      =>
			[
				'heading_raw',
				'image_list' =>
				[
					'file_gallery',
					'title',
					'link_raw',
					'target',
				],
				'image_add',

				'description',
				'image_random',
				// sub page
				'style' => \content_site\options\style::option_list(
				[
					'container',
					// 'font',
					'height',
					'background_pack',
					// 'color_heading',
					'radius_full',
					'coverratio',
					// 'effect',
					'image_mask',
					'type',
				]),
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
			'preview_title'  => T_("Card"),
			'version'        => 1,
		];
	}


}
?>