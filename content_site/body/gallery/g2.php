<?php
namespace content_site\body\gallery;


class g2
{

	/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option()
	{
		\content_site\options\background\background_pack::remove_from_list('coverratio');

		$master_option =
		[

			'heading_raw',
			'image_list' =>
			[
				'file_gallery',
				'caption',
				'description',
			],
			'image_add',

			'description',
			'image_random',

			// sub page
			'style' => \content_site\options\style::option_list(),
		];

		return
		[
			'title'        => T_("Gallery 1"),
			'default'      => option::master_default(['type' => 'g2'], 6),
			'options'      => $master_option,
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